<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use SimpleXMlElement;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\UploadedFile;

class OrderMakerController extends Controller
{

    protected function exibeMsg($tipo,$mensagem){
        if ($tipo!='Erro'){
                    \Session::flash('flash_message', [
                        'title' => "Aviso",
                        'msg'=>$mensagem,
                        'class' => "success",
                    ]);
                }else {
                    \Session::flash('flash_message', [
                        'title' => "Aviso",
                        'msg' => $mensagem,
                        'class' => "error",
                    ]);
                }
    } //exibeMsg


    protected function lerCSV($filename){
        if(!file_exists($filename) || !is_readable($filename))
            return 'Arquivo não encontrado: ' . $filename;

        $header = NULL;
        $data = array();
        if (($handle = fopen($filename, 'r')) !== FALSE)
        {
            while (($row = fgetcsv($handle, 1000, ';')) !== FALSE)
            {
                if(!$header)
                    $header = $row;
                else
                    $data[] = array_combine($header, $row);
            }
            fclose($handle);
        }
        return $data;
    }

    protected function executaApi($tipo,$parametro) { //se funcao receber somente $tipo apenas retorna o parametro
        $url_api = \App\Parametro::where([
            ['controle'  , 'ordermaker'],
            ['empresa_id', 1],
            ['user_id'   , 1],
            ['tipo'      , $tipo]
        ])->first();

        if ($url_api == null) return ('Parametro order maker nao encontrado: '. $tipo);
        if ($url_api->parametro == '') return ('Url invalida ou nao encontrada: '. $tipo);

        if ( $parametro == '' ) return $url_api->parametro;

        if ( $parametro == 'NA') $parametro = '';

        $url = $this->executaApi('url_api','');
        $token = $this->executaApi('token','');
        $headers = array('Content-Type' => 'application/json','Authorization' => ('Bearer '. $token));

        $url_api->parametro = ($url . $url_api->parametro);

        if (strpos($url_api->parametro, 'atualiza') != 0) {
            $url_api->body = $parametro;
            return (\Requests::put($url_api->parametro,$headers,json_encode($url_api->body)));
        }
        else if (strpos($url_api->parametro, 'novo') != 0) {
            $url_api->body = $parametro;
            return (\Requests::post($url_api->parametro,$headers,json_encode($url_api->body)));
        }
        else {
            $url_api->parametro  = str_replace('{param}',$parametro,$url_api->parametro);
            return json_decode(\Requests::get( $url_api->parametro , $headers)->body);
        }

    } //executaApi

    public function listaPedidos() {
        $url_api = $this->executaApi('url_api','');
        $token = $this->executaApi('token','');
        $token = ('Bearer '. $token);
        $parametro = $this->executaApi('listapedidos','');

        $parametro  = str_replace('{param}','2',$parametro);

        $url_api = $url_api . $parametro;

        return view('ordermaker.interface', compact("url_api","token"));
    } //listaPedidos

    public function interface() {
        return view('ordermaker.interface');
    }

    public function geraXml(Request $request) {
        $pedidos = $this->executaApi('listapedidos','2');

        if ($pedidos == null) {
            $this->exibeMsg('Erro','Nenhum pedido para geração.');
            return redirect()->route('ordermaker.listaPedidos');
        }

        //parametros
        $AmbienteSAP = $this->executaApi('interface_ambiente','');

        if ($AmbienteSAP == null) {
            $this->exibeMsg('Erro','Ambiente SAP não configurado.');
            return redirect()->route('ordermaker.listaPedidos');
        }

        $PastaDestino = $this->executaApi('FTP_SYSFILES_BASE_DIR','');

        if ($PastaDestino == null) {
            $this->exibeMsg('Erro','Pasta destino nao configurado.');
            return redirect()->route('ordermaker.listaPedidos');
        }

        $filePath = ('ftp://'.env("FTP_SYSFILES_USER","ROOT").":".env("FTP_SYSFILES_PASS","")."@".env("FTP_SYSFILES","").$PastaDestino);

        //C:/TEMP/ORDERMAKER/';
        $fileDat = '01702_'.$AmbienteSAP.'_LS_BR_AGV_'. date('YmdGis').'_904665626.dat'; //01702_GDV_LS_BR_AGV_20170105170931.dat
        /*
            01702_XXX_pppppppppp_yyyymmddhhmmss*.dat
            XXX =  ambiente SAP:
            Para os testes de Janeiro e Fevereiro XXX = GDV
            Para os testes de Março a Abril XXX = GQA
            Para ambiente produtivo no Go-live XXX = GPR
            pppppppppp = partner number LS_BR_AGV
        */

        $fileXml = new SimpleXMLElement('<?xml version="1.0" encoding="UTF-8"?>' //header do arquivo
                          .'<SALESORDER_CREATEFROMDAT204>'
                          .'</SALESORDER_CREATEFROMDAT204>');

        foreach($pedidos as $pedido){
            $data_fatura  = str_replace('-','',$pedido->data_fatura);
            $data_entrega = str_replace('-','',$pedido->data_entrega);
            $end_faturamento = str_pad($pedido->cliente->end_faturamento, 10, "0", STR_PAD_LEFT);
            $end_entrega     = str_pad($pedido->cliente->end_entrega,     10, "0", STR_PAD_LEFT);
            //

            $idoc = $fileXml->addChild('IDOC');                                 //header do pedido
            $idoc->addAttribute('BEGIN', '1');

            $edi_dc40 = $idoc->addChild('EDI_DC40');
            $edi_dc40->addAttribute('SEGMENT', '1');
                $edi_dc40->addChild('TABNAM','EDI_DC40');                       //fixo interno
                $edi_dc40->addChild('DIRECT','2');                              //fixo interno
                $edi_dc40->addChild('IDOCTYP','SALESORDER_CREATEFROMDAT204');   //fixo interno
                $edi_dc40->addChild('MESTYP','SALESORDER_CREATEFROMDAT2');      //fixo interno
                $edi_dc40->addChild('SNDPRT','LS');                             //fixo interno
                $edi_dc40->addChild('SNDPFC','LS');                             //fixo interno
                $edi_dc40->addChild('SNDPRN','LS_BR_AGV');                      //fixo interno
                $edi_dc40->addChild('RCVPRT','LS');                             //fixo interno

            $e1salesorder = $idoc->addChild('E1SALESORDER_CREATEFROMDAT2');     //header dos itens
            $e1salesorder->addAttribute('SEGMENT', '1');

                $E1BPSDHD1 = $e1salesorder->addChild('E1BPSDHD1');
                $E1BPSDHD1->addAttribute('SEGMENT', '1');
                    //
                    $E1BPSDHD1->addChild('DOC_TYPE',$pedido->tipovenda->codigo);  //Tipo de Documento*: Z01 / ZB01 / Z10 / ZRCS
                    $E1BPSDHD1->addChild('SALES_ORG','1843');                     //fixo
                    $E1BPSDHD1->addChild('DISTR_CHAN','01');                      //fixo
                    $E1BPSDHD1->addChild('DIVISION','02');                        //fixo
                    $E1BPSDHD1->addChild('REQ_DATE_H',$data_fatura);              //Data do Pedido*
                    $E1BPSDHD1->addChild('PURCH_DATE',$data_entrega);             //Data de Entrega do Cliente*
                    $E1BPSDHD1->addChild('PMNTTRMS',$pedido->condpagto->codigo);          //Condição de Pagamento*

                    if ($pedido->tipovenda->codigo == 'ZRCS') {                   //op triangular
                        $E1BPSDHD1->addChild('BILL_BLOCK','02');                  //Fixo
                    } else {
                        $E1BPSDHD1->addChild('DLV_BLOCK','Z6');                   //Fixo
                    }

                    $E1BPSDHD1->addChild('PURCH_NO_C',$pedido->pedido_cliente); //Pedido do Cliente*
                    $E1BPSDHD1->addChild('PURCH_NO_S',$pedido->id);             //Pedido Portal
                    $E1BPSDHD1->addChild('REF_DOC_L',$pedido->representante->codigo);   //Codigo do Representante*
                    //
                $E1BPSDLS = $e1salesorder->addChild('E1BPSDLS');                //header interna
                $E1BPSDLS->addAttribute('SEGMENT', '1');
                    //
                    $E1BPSDLS->addChild('COND_HANDL','X');                      //fixo
                    //

            $peditens = $this->executaApi('listaitens',$pedido->id);
            foreach($peditens as $pediten){

                    $E1BPSDITM = $e1salesorder->addChild('E1BPSDITM');
                    $E1BPSDITM->addAttribute('SEGMENT', '1');
                        //
                        $E1BPSDITM->addChild('ITM_NUMBER',$pediten->numero_item * 10);              //Numero do Item Deve ser 10, 20..
                        $E1BPSDITM->addChild('MATERIAL',$pediten->produto->codigo);                 //Codigo do Produto*
                        $E1BPSDITM->addChild('TARGET_QTY',$pediten->qtd);                           //Quantidade do pedido*
                        $E1BPSDITM->addChild('TARGET_QU', $pediten->produto->unidade);              //Unidade do Produto
                        if ($pedido->tipovenda_id == 'Z10') {                                       //somente informar se bonif.
                            $E1BPSDITM->addChild('ITEM_CATEG','Z10B');                              //Fixo quando devolução (Z10)
                        }
                        //
                }

                $E1BPPARNR_AG = $e1salesorder->addChild('E1BPPARNR');
                $E1BPPARNR_AG->addAttribute('SEGMENT', '1');
                    //
                    $E1BPPARNR_AG->addChild('PARTN_ROLE','AG');                        //AG: Parceiro para quem estou vendendo
                    $E1BPPARNR_AG->addChild('PARTN_NUMB',$end_faturamento);            //Codigo do Cliente SAP

                $E1BPPARNR_WE = $e1salesorder->addChild('E1BPPARNR');
                $E1BPPARNR_WE->addAttribute('SEGMENT', '1');
                    //
                    if ($pedido->tipovenda->codigo == 'ZRCS') {                 //op triangular replicar end_faturamento para entrega
                        $E1BPPARNR_WE->addChild('PARTN_ROLE','WE');             //WE: Parceiro para quem estou entregando
                        $E1BPPARNR_WE->addChild('PARTN_NUMB',$end_faturamento); //Codigo do Cliente SAP
                    } else {
                        $E1BPPARNR_WE->addChild('PARTN_ROLE','WE');
                        $E1BPPARNR_WE->addChild('PARTN_NUMB',$end_entrega);
                    }

                if ($pedido->tipovenda->codigo == 'ZRCS') {
                    $E1BPPARNR_ZS = $e1salesorder->addChild('E1BPPARNR');
                    $E1BPPARNR_ZS->addAttribute('SEGMENT', '1');
                        //
                        $E1BPPARNR_ZS->addChild('PARTN_ROLE','ZS');             //ZS: op triangular (ZRCS) recebedor final
                        $E1BPPARNR_ZS->addChild('PARTN_NUMB',$end_entrega);     //Codigo do Cliente SAP
                        //
                }

                foreach($peditens as $pediten){
                    $E1BPSCHDL = $e1salesorder->addChild('E1BPSCHDL');              //tag de informações complementares do item
                    $E1BPSCHDL->addAttribute('SEGMENT', '1');
                        //
                        $E1BPSCHDL->addChild('ITM_NUMBER',$pediten->numero_item * 10); //Numero do Item* Deve ser 10, 20..
                        $E1BPSCHDL->addChild('SCHED_LINE','0001');                  //fixo
                        $E1BPSCHDL->addChild('REQ_QTY',($pediten->qtd));            //quantidade do item*
                        //
                }
                foreach($peditens as $pediten){
                    if (($pediten->desconto) > 0) {
                        $E1BPCOND = $e1salesorder->addChild('E1BPCOND');                //tag de desconto do item
                        $E1BPCOND->addAttribute('SEGMENT', '1');

                            $E1BPCOND->addChild('ITM_NUMBER',$pediten->numero_item * 10);  //Numero do Item* Deve ser 10, 20..
                            $E1BPCOND->addChild('COND_TYPE','ZK16');                  //fixo
                            $E1BPCOND->addChild('COND_VALUE',($pediten->desconto));   //valor da condição
                    }
                }

                if ($pedido->obs_faturamento <> '') {

                    $textos =  explode( "\n" , $pedido->obs_faturamento );

                    $icontrol = 0;
                    foreach($textos as $texto){
                        $icontrol = $icontrol + 1;
                        $E1BPSDTEXT= $e1salesorder->addChild('E1BPSDTEXT');     //tag de observações do faturamento
                        $E1BPSDTEXT->addAttribute('SEGMENT', '1');
                            //
                            $E1BPSDTEXT->addChild('TEXT_ID','0001');            //fixo 0001 para obs do faturamento
                            $E1BPSDTEXT->addChild('LANGU','P');                 //P
                            if ($icontrol > 1) {
                                $E1BPSDTEXT->addChild('FORMAT_COL','*');        //Item usado para quando houver <ENTER> no texto
                            }
                            $E1BPSDTEXT->addChild('TEXT_LINE',$texto);          //obs do faturamento
                            //
                    }
                }
                if ($pedido->obs_pedido <> '') {

                    $textos =  explode( "\n" , $pedido->obs_pedido );

                    $icontrol = 0;
                    foreach($textos as $texto){
                        $icontrol = $icontrol + 1;
                        $E1BPSDTEXT= $e1salesorder->addChild('E1BPSDTEXT');     //tag de observações do pedido
                        $E1BPSDTEXT->addAttribute('SEGMENT', '1');
                            //
                            $E1BPSDTEXT->addChild('TEXT_ID','0002');            //fixo 0002 obs pedido
                            $E1BPSDTEXT->addChild('LANGU','P');                 //P
                            if ($icontrol > 1) {
                                $E1BPSDTEXT->addChild('FORMAT_COL','*');        //Item usado para quando houver <ENTER> no texto
                            }
                            $E1BPSDTEXT->addChild('TEXT_LINE',$texto);          //obs do pedido
                    }
                }
        } //foreach pedidos

        //print htmlentities( $fileXml->asXML()); -- exibir na tela

        $arquivo = fOpen($filePath.$fileDat,'w');
        fWrite($arquivo,$fileXml->asXml());
        fClose($arquivo);

        foreach($pedidos as $pedido){
            $pedido->edi = ($fileDat);
            $pedido->data_edi = date('Y:m:d: G:i:s');
            $pedido->status = 3;

            $this->executaApi('atualizapedido',$pedido);
        }

        $this->exibeMsg('Sucesso','Arquivo gerado: '.$fileDat);
        return redirect()->route('ordermaker.listaPedidos');
    } //geraxml

    public function importacsv(Request $request) {

        $nome_original = $_FILES["arquivo"]["name"];
        $arquivo = $request->arquivo;

        if ($arquivo == null) {
            $this->exibeMsg('Erro','Arquivo inválido: '.$nome_original);
            return redirect()->route('ordermaker.importacao');
        }


        $registros = $this->lerCSV($arquivo);

        $ok = 0;
        if (!(is_array($registros)))
            return $registros;

        if ( count($registros) == 0 ) {
            $this->exibeMsg('Erro','Nenhum registro apurado: '.$nome_original);
            return redirect()->route('ordermaker.importacao');
        }
        if ($nome_original=='clientes.csv') {
            foreach($registros as $registro){
                $status = $this->executaApi('novocliente',$registro);
                if ( $status->status_code == 200)
                    $ok = $ok + 1;
                }
        } //clientes.csv

        else if ($nome_original=='produtos.csv') {

            foreach($registros as $registro){

                $tabela_id = 0;
                $tab = $this->executaApi('buscacodprodgrupo',$registro["prodgrupo_id"]);
                if ($tab->sucess == true) {
                    $tabela_id = ($tab->data[0]->id);
                    $registro["prodgrupo_id"] = (string)$tabela_id;

                    $status = $this->executaApi('novoproduto',$registro);
                    if ( $status->status_code == 200)
                        $ok = $ok + 1;
                }
            }
        } //produtos.csv

        else if ($nome_original=='tabelaprecos.csv') {

            foreach($registros as $registro){
                $tabela_id = 0;
                $tab = $this->executaApi('buscacodproduto',$registro["produto_id"]);
                if ($tab->sucess == true) {
                    $tabela_id = ($tab->data[0]->id);
                    $registro["produto_id"] = (string)$tabela_id;
                }

                $status = $this->executaApi('novotabelapreco',$registro);
                if ( $status->status_code == 200)
                    $ok = $ok + 1;
            }
        } //tabelaprecos.csv

        else if ($nome_original=='condpagto.csv') {

            foreach($registros as $registro){
                $status = $this->executaApi('novocondpagto',$registro);
                if ( $status->status_code == 200)
                    $ok = $ok + 1;
            }
        } //condpagto.csv

        else {
            $this->exibeMsg('Erro','Arquivo não parametrizado: '.$nome_original);
            return redirect()->route('ordermaker.importacao');
        }
        $this->exibeMsg('Sucesso',('Registros inseridos ' . $ok . ' de ' . count($registros) ));
        return redirect()->route('ordermaker.importacao');
    } //importacsv

    public function importacao() {
        return view('ordermaker.importacao');
    }

    //chamada de views:
    function pedido($dados = null){

        $url_api = $this->executaApi('url_api','');
        $token = ('Bearer ' . $this->executaApi('token',''));

        $tipovenda = $this->executaApi('listatipovenda','NA');  //combo de tipo de vendas
        $condpagto = $this->executaApi('listacondpagto','NA');  //combo de condições de pagto
        $prodgrupo = $this->executaApi('listaprodgrupo','NA');  //combo de grupo de produtos

        //com parametros
        $url_representante = $url_api . $this->executaApi('buscacodrepresentante',''); //api para buscar nome do representante //akialdo
        $url_representante = str_replace('{param}', '', $url_representante);

        $url_cidade = $url_api . $this->executaApi('listacidades',''); //api para buscar cidades de uma uf selecionada
        $url_cidade = str_replace('{param}', '', $url_cidade);

        $url_cliente_id = $url_api . $this->executaApi('buscacliente',''); //api para buscar dados adicionais do cliente
        $url_cliente_id = str_replace('{param}', '', $url_cliente_id);
        
        $url_pedido_totais = $url_api . $this->executaApi('buscapedido',''); //api para buscar os totais do pedido
        $url_pedido_totais = str_replace('{param}', '', $url_pedido_totais);

        $url_exclui_item = $url_api . $this->executaApi('removepediten',''); //api para buscar os totais do pedido
        $url_exclui_item = str_replace('{param}', '', $url_exclui_item);

        //sem parametros
        $url_produto         = $url_api . $this->executaApi('listaproduto',''); //api para buscar os produtos
        $url_cliente         = $url_api . $this->executaApi('listacliente',''); //api para buscar clientes
        $url_pediten_lista   = $url_api . $this->executaApi('listapeditens',''); //api para buscar clientes
        $url_pediten         = $url_api . $this->executaApi('novopediten','');  //api para novo item
        $url_pedido_novo     = $url_api . $this->executaApi('novopedido','');  //api para novo pedido
        $url_pedido_atualiza = $url_api . $this->executaApi('atualizapedido','');  //api para atualizar pedido

        return view('ordermaker.inclusao_pedido', [
                'tipovenda' => $tipovenda->data,
                'condpagto' => $condpagto->data,
                'prodgrupo' => $prodgrupo->data,
                'token' => $token,
                'url_produto' => $url_produto,
                'url_representante' => $url_representante,
                'url_cliente' => $url_cliente,
                'url_cidade' => $url_cidade,
                'url_cliente_id' => $url_cliente_id,
                'url_pediten_lista' => $url_pediten_lista,
                'url_pediten' => $url_pediten,
                'url_pedido_novo' => $url_pedido_novo,
                'url_pedido_atualiza' => $url_pedido_atualiza,
                'url_pedido_totais' => $url_pedido_totais,
                'url_exclui_item' => $url_exclui_item
            ]);
    } //pedido

    function prodgrupo(){
        return view("ordermaker.prodgrupo");
    }

    function aprovacao(){
        return view("ordermaker.painel_aprovacao");
    }

    function cliente(){
        return view("ordermaker.cadastro_cliente");
    }

    function visaovendas(){
        return view("ordermaker.visao_vendas");
    }

} //OrderMakerController

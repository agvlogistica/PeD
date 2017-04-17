<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\BaixaEntrega;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Parametro;

use Illuminate\Support\Facades\Auth;

class ListaNotas extends Controller
{

    private $url;

    function __construct(){

      $parametro = new Parametro();

      $url = $parametro->where([
        ['controle','=','URL'],
        ['tipo','=','API_ALVO']
      ])->first();

      $this->url = $url->parametro;

    }

    public function listaNotas(Request $request){

      // Parametrizando a lista de ct-e por transportadora
      $cod_transp = array();

      $p_baixaentrega = Auth::user()->parametros->where('controle','=','BAIXA_ENTREGA');

      $p_transportadora = $p_baixaentrega->where('tipo','=','TRANSPORTADORA');

      foreach($p_transportadora as $transp){
        $cod_transp[] = $transp->parametro;
      }
      //--------------------------------------------------

      $dados = $request->all();
      $param = array();
      $url   = "";

      //$headers = array('Content-Type' => 'application/json');
      //$option = array('timeout' => 60,);

      //$param['codtransp'] = implode(',',$cod_transp);

      $url   = $this->url."lista_ctes";

      //$send = \Requests::post($url,$headers,$param,$option);

      return view('BaixaEntrega.index',[
        'url'   => $url,
        'codtransp' => implode(',',$cod_transp)
      ]);

    }

    /**
     * @param $cte
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function abreCte($cte){

      // Parametrizando os botões de acordo com a parametrização
      $autoco = array();
      $autgravar = array();

      $p_baixaentrega = Auth::user()->parametros->where('controle','=','BAIXA_ENTREGA');
      $p_ocorrencia = $p_baixaentrega->where('tipo','=','BTN_OCORRENCIA');
      $p_gravar = $p_baixaentrega->where('tipo','=','BTN_GRAVAR');

      foreach($p_ocorrencia as $oco){
           $autoco = explode(',',$oco->parametro);
      }

      foreach($p_gravar as $gravar){
           $autgravar = explode(',',$gravar->parametro);
      }
      //--------------------------------------------------------

      $urlcte     = $this->url."detalhes_cte/$cte";
      $urlnot     = $this->url."lista_notas/$cte";
      $urlstatus  = $this->url."lista_statuscte";

      $sendcte = \Requests::get($urlcte);
      $sendnot = \Requests::get($urlnot);
      $send_statuscte = \Requests::get($urlstatus);

      $dados_cte = json_decode($sendcte->body);
      $dados_not = json_decode($sendnot->body);
      $dados_statuscte = json_decode($send_statuscte->body);

      //Autorizando o botão Gravar
      if(in_array($dados_cte->transp_codigo,$autgravar)){
        $gravar = true;
      }else{
        $gravar = false;
      }
      //--------------------------


      //Autorizando o botão Ocorrência
      if(in_array($dados_cte->transp_codigo,$autoco)){
        $ocorrencia = true;
      }else{
        $ocorrencia = false;
      }
      //--------------------------

      return view('BaixaEntrega.show',[
          'cte'   => $dados_cte,
          'notas' => $dados_not,
          'statuscte' => $dados_statuscte,
          'gravar' => $gravar,
          'ocorrencia' => $ocorrencia,
        ]);
    }

    public function abreOcorrencia($cte){

      // Parametrizando os botões de acordo com a parametrização
      $autoco = array();

      $p_baixaentrega = Auth::user()->parametros->where('controle','=','BAIXA_ENTREGA');
      $p_ocorrencia = $p_baixaentrega->where('tipo','=','BTN_OCORRENCIA');
      $p_gravar = $p_baixaentrega->where('tipo','=','BTN_GRAVAR');

      foreach($p_ocorrencia as $oco){
           $autoco = explode(',',$oco->parametro);
      }
      //--------------------------------------------------------

      $urlcte     = $this->url."detalhes_cte/$cte";
      $urlnot     = $this->url."lista_notas/$cte";
      $urloco     = $this->url."lista_ocorrencia";
      $urlstatus  = $this->url."lista_statuscte";

      $sendcte = \Requests::get($urlcte);
      $sendnot = \Requests::get($urlnot);
      $sendoco = \Requests::get($urloco);
      $send_statuscte = \Requests::get($urlstatus);

      $dados_cte = json_decode($sendcte->body);
      $dados_not = json_decode($sendnot->body);
      $dados_oco = json_decode($sendoco->body);
      $dados_statuscte = json_decode($send_statuscte->body);

      //Autorizando o botão Ocorrência
      if(in_array($dados_cte->transp_codigo,$autoco)){

        return view('BaixaEntrega.showocorrencia',[
            'cte'   => $dados_cte,
            'notas' => $dados_not,
            'ocorrencias' => $dados_oco,
            'statuscte' => $dados_statuscte
        ]);

      }else{
        return redirect()->route('baixaentrega');
      }
      //------------------------------

    }

    public function gravaInfoCte(Request $request){

      $dados = $request->all();

      $urlbaixacte = $this->url."baixa_cte";
      $urlstatus   = $this->url."set_status_cte";

      $param = array();

      if(isset($dados['dataentrega']) && !empty($dados['dataentrega'])){

        $param[] = [
          'cte_chave' => $dados['cte_chave'],
          'nf_dt_entrega' => $this->formataDataBanco($dados['dataentrega']),
          'nf_resp_receber' => strtoupper($this->removeAcentos($dados['recebedor'])),
          'cte_obs' => strtoupper($this->removeAcentos($dados['obs_cte'])),
          'cte_status' => $dados['status'],
          'cte_info_controle' => 'W'
        ];

        $headers = array('Content-Type' => 'application/json');
        $resultado = \Requests::post($urlbaixacte, $headers, json_encode($param));

        return redirect()->route('baixaentrega');

      }else{

        if(!empty($dados['status']) && $dados['status'] != '8'){
          $param[] = [
            'cte_chave' => $dados['cte_chave'],
            'cte_status' => $dados['status'],
            'cte_obs' => strtoupper($this->removeAcentos($dados['obs_cte'])),
            'cte_info_controle' => 'W'
          ];

          $headers = array('Content-Type' => 'application/json');
          $resultado = \Requests::post($urlstatus, $headers, json_encode($param));

          return redirect()->route('baixaentrega');
        }
      }
    }

    public function gravaInfocorrencia(Request $request){

      $dados = $request->all();

      $urlbaixanota   = $this->url."baixa_entrega";
      $urlbaixacte    = $this->url."baixa_cte";
      $urlstatus      = $this->url."/v1/set_status_cte";

      $param = array();
      $fields = array();
      $dataentrega = "";

      if(isset($dados['data_entrega']) && !empty($dados['data_entrega'])){
        $dataentrega = $this->formataDataBanco($dados['data_entrega']);
      }

      foreach($dados as $k => $v){

        $oco    = "";
        $obsoco = "";

        if(strpos($k,"cmbocorrencia_") === false){
        }else{
          if(!empty($v)){

            $c = explode('_',$k);
            $chave = $c[1];

            if(!empty($dados['cmbocorrencia_'.$chave])){
              $oco = $dados['cmbocorrencia_'.$chave];

              if(!empty($dados['obsoco_'.$chave])){
                $obsoco = $dados['obsoco_'.$chave];
              }
            }

            $param[] = [
              'nf_chave' => $chave,
              'nf_dt_entrega' => $dataentrega,
              'nf_resp_receber' => strtoupper($this->removeAcentos($dados['recebedor'])),
              'nf_ocorrencia' => $oco,
              'nf_obs' => strtoupper($this->removeAcentos($obsoco)),
              'cte_info_controle' => 'W',
              'cte_id' => $dados['cte_id']
            ];
          }
        }
      }

      $headers = array('Content-Type' => 'application/json');
      $resultado1 = \Requests::post($urlbaixanota, $headers, json_encode($param));

      /** Replicando a data de entrega para todas as notas **/
      if(isset($dados['data_entrega']) && !empty($dados['data_entrega'])){

        $paramcte[] = [
          'cte_chave' => $dados['cte_chave'],
          'nf_dt_entrega' => $this->formataDataBanco($dados['data_entrega']),
          'nf_resp_receber' => strtoupper($this->removeAcentos($dados['recebedor'])),
          'cte_info_controle' => 'W'
        ];

        $resultado2 = \Requests::post($urlbaixacte, $headers, json_encode($paramcte));

      }

      if(isset($dados['status']) && !empty($dados['status'])){
        $paramstatus[] = [
          'cte_chave' =>  $dados['cte_chave'],
          'cte_status' => $dados['status'],
          'cte_obs' => strtoupper($this->removeAcentos($dados['obs_cte'])),
          'cte_info_controle' => 'W'
        ];

        $headers = array('Content-Type' => 'application/json');
        $resultado3 = \Requests::post($urlstatus, $headers, json_encode($paramstatus));

      }

      return redirect()->route('baixaentrega');
    }

    public function formataDataBanco($data){
      $dt = explode('/',$data);
      $data = $dt[2]."-".$dt[1]."-".$dt[0];

      return $data;
    }

    public function removeAcentos($string){
      $map = array(
          'á' => 'a',
          'à' => 'a',
          'ã' => 'a',
          'â' => 'a',
          'é' => 'e',
          'ê' => 'e',
          'í' => 'i',
          'ó' => 'o',
          'ô' => 'o',
          'õ' => 'o',
          'ú' => 'u',
          'ü' => 'u',
          'ç' => 'c',
          'Á' => 'A',
          'À' => 'A',
          'Ã' => 'A',
          'Â' => 'A',
          'É' => 'E',
          'Ê' => 'E',
          'Í' => 'I',
          'Ó' => 'O',
          'Ô' => 'O',
          'Õ' => 'O',
          'Ú' => 'U',
          'Ü' => 'U',
          'Ù' => 'U',
          'Ç' => 'C'
      );

      $string = strtr($string,$map);

      return $string;
    }
}

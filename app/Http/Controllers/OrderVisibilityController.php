<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Parametro;
use Illuminate\Support\Facades\Auth;

class OrderVisibilityController extends Controller
{

    private $url;

    function __construct(){

      $parametro = new Parametro();

      $url = $parametro->where([
        ['controle','=','URL'],
        ['tipo','=','API_TMS']
      ])->first();

      $this->url = $url->parametro;

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        //Parâmetros para a api
        $dados = $request->all();

        //Parametrização
        $p_baixa    = Auth::user()->parametros->where('controle','=','BAIXA_ENTREGA');
        $p_visao    = $p_baixa->where('tipo','=','VISAO')->first();
        //--------------

        $cnpj   = $p_visao->parametro;
        $dtini  = '';
        $dtfim  = '';

        if(isset($dados['dtini'])){
            $dtini = $dados['dtini'];
        }

        if(isset($dados['dtfim'])){
            $dtfim = $dados['dtfim'];
        }

        $dadosresumidos = $this->dadosResumidos($cnpj,$dtini,$dtfim);

        return view('OrderVisibility.index',$dadosresumidos);

    }

    public function dadosResumidos($cnpj,$dtini,$dtfim){

        $timestamp_today = strtotime('Today');

        //API de consulta dos dados
        $url = $this->url."order_visibility/gestao/busca";
        $headers = array('Content-Type' => 'application/json');
        $option = array('timeout' => 30,);
        //-------------------------

        //---------------------
        if(empty($dtini) && empty($dtfim)){
            $dtini = date('d/m/Y',strtotime('-30 days',$timestamp_today));
            $dtfim = date('d/m/Y',$timestamp_today);
        }

        $idrecebidos  = "1";
        $idseparados  = "2";
        $idexpedidos  = "3";
        $idtransporte = "4";
        $identregue   = "5";
        $idocorrencia = "6";
        //---------------------

        $param = [
            'cnpj'            => $cnpj,
            'data_inicial'    => $dtini,
            'data_final'      => $dtfim,
            'visao'           => '1'
        ];

        //Notas Recebidas
        $param['id'] = $idrecebidos;

        $api = \Requests::post($url,$headers,json_encode($param),$option);

        $recebidos = json_decode($api->body);

        $dadosrecebidos = [
          'qtd'       => $recebidos[0]->qtd,
          'valor'     => number_format($recebidos[0]->valor,2,',','.'),
          'unidades'  => $recebidos[0]->unidades,
          'volumes'   => $recebidos[0]->volumes,
          'linhas'    => $recebidos[0]->linha,
          'peso'      => $recebidos[0]->peso,
          'id'        => $idrecebidos
        ];
        //--------------

        //Em Separação
        $param['id'] = $idseparados;
        $api = \Requests::post($url,$headers,json_encode($param),$option);

        $separados = json_decode($api->body);

        $dadosseparados = [
          'qtd'       => $separados[0]->qtd,
          'valor'     => number_format($separados[0]->valor,2,',','.'),
          'unidades'  => $separados[0]->unidades,
          'volumes'   => $separados[0]->volumes,
          'linhas'    => $separados[0]->linha,
          'peso'      => $separados[0]->peso,
          'id'        => $idseparados
        ];
        //--------------

        //Em Expedição
        $param['id'] = $idexpedidos;
        $api = \Requests::post($url,$headers,json_encode($param),$option);

        $expedidos = json_decode($api->body);

        $dadosexpedidos = [
          'qtd'       => $expedidos[0]->qtd,
          'valor'     => number_format($expedidos[0]->valor,2,',','.'),
          'unidades'  => $expedidos[0]->unidades,
          'volumes'   => $expedidos[0]->volumes,
          'linhas'    => $expedidos[0]->linha,
          'peso'      => $expedidos[0]->peso,
          'id'        => $idexpedidos
        ];
        //--------------

        //Em transporte
        $param['id'] = $idtransporte;
        $api = \Requests::post($url,$headers,json_encode($param),$option);

        $transportes = json_decode($api->body);

        $dadostransporte = [
          'qtd'       => $transportes[0]->qtd,
          'valor'     => number_format($transportes[0]->valor,2,',','.'),
          'unidades'  => $transportes[0]->unidades,
          'volumes'   => $transportes[0]->volumes,
          'linhas'    => $transportes[0]->linha,
          'peso'      => $transportes[0]->peso,
          'id'        => $idtransporte
        ];
        //--------------

        //Entrega realizada
        $param['id'] = $identregue;
        $api = \Requests::post($url,$headers,json_encode($param),$option);

        $entregues = json_decode($api->body);

        $dadosentregue = [
          'qtd'       => $entregues[0]->qtd,
          'valor'     => number_format($entregues[0]->valor,2,',','.'),
          'unidades'  => $entregues[0]->unidades,
          'volumes'   => $entregues[0]->volumes,
          'linhas'    => $entregues[0]->linha,
          'peso'      => $entregues[0]->peso,
          'id'        => $identregue
        ];
        //--------------

        //Com ocorrência
        $param['id'] = $idocorrencia;
        $api = \Requests::post($url,$headers,json_encode($param),$option);

        $ocorrencias = json_decode($api->body);

        $dadosocorrencia = [
          'qtd'       => $ocorrencias[0]->qtd,
          'valor'     => number_format($ocorrencias[0]->valor,2,',','.'),
          'unidades'  => $ocorrencias[0]->unidades,
          'volumes'   => $ocorrencias[0]->volumes,
          'linhas'    => $ocorrencias[0]->linha,
          'peso'      => $ocorrencias[0]->peso,
          'id'        => $idocorrencia
        ];
        //--------------

        $dadosresumidos = [
          'url'           => $url,
          'cnpj'          => $cnpj,
          'recebidos'     => $dadosrecebidos,
          'separados'     => $dadosseparados,
          'expedidos'     => $dadosexpedidos,
          'transporte'    => $dadostransporte,
          'entregue'      => $dadosentregue,
          'ocorrencia'    => $dadosocorrencia,
          'data_inicial'  => $dtini,
          'data_final'    => $dtfim
        ];

        return $dadosresumidos;

        /*

        */
    }

    public function recebimento(){
      return view('OrderVisibility.recebimento');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

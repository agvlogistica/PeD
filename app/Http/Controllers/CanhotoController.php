<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Http\Requests;

class CanhotoController extends Controller
{
    private $token_api;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $parametro = \App\Parametro::where([
                ['empresa_id', Auth::user()->empresa_id],
                ['controle', 'API_ALVO'],
                ['tipo', 'TOKEN']
            ])->first();

            if (!$parametro) {
                \Session::flash('flash_message', [
                    'msg' => "API não parametrizada, contate o administrador (TOKEN)!",
                    'title' => "Cadastro de Parâmetro",
                    'class' => "error",
                ]);

                return redirect('/');
            }

            $this->token_api = $parametro->parametro;

            return $next($request);
        });

    }

    /**
     * index
     * Exibe a lista de CT-e.
     *
     * @param Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $token_api = $this->token_api;

        // Verifica parametrização do Portal CSC
        $parametro = \App\Parametro::where([
            ['empresa_id', \Auth::user()->empresa_id],
            ['controle', 'CANHOTO'],
            ['tipo', 'API_LISTA_CTE']
        ])->first();

        if (!$parametro) {
            \Session::flash('flash_message', [
                'msg' => "API não parametrizada, contate o administrador (API_LISTA_CTE)!",
                'title' => "Cadastro de Parâmetro",
                'class' => "error",
            ]);

            return redirect('/');
        }

        $url_api = $parametro->parametro;

        $transportadora = "!!!";

        $parametro = Auth::user()->busca_parametros('CANHOTO', 'FILTRO_TRANSPORTADORA')->first();

        if ($parametro) {
            $transportadora = $parametro->parametro;
        }

        return view('canhoto.index', compact('token_api', 'url_api', 'transportadora'));
    }

    public function detalhe($cte_id){

        $token_api = $this->token_api;

        $url_api = \App\Parametro::where([
            ['controle', 'CANHOTO'],
            ['empresa_id', \Auth::user()->empresa_id],
            ['tipo', 'API_LISTA_NOTA'],
        ])->first();

        $url_detalheCte = \App\Parametro::where([
            ['controle', 'CANHOTO'],
            ['empresa_id', \Auth::user()->empresa_id],
            ['tipo', 'API_DADOS_CTE'],
        ])->first();

        $json = $url_api->parametro.'/'.$cte_id;

        $client = new \GuzzleHttp\Client();

        try {
            $response = $client->request("GET", "{$url_detalheCte->parametro}/{$cte_id}", [
                'headers' => [
                    'Accept' => "application/json",
                    'Authorization' => "Bearer {$this->token_api}"
                ]
            ]);
        } catch (\GuzzleHttp\Exception\ClientException $e) {
            \Session::flash('flash_message', [
                'msg' => $e->getResponse()->getReasonPhrase(),
                'title' => "StatusCod: {$e->getResponse()->getStatusCode()}",
                'class' => "error",
            ]);

            return back();
        }

        $cte = json_decode($response->getBody());

        return view('canhoto.detalhe', compact('json','cte', 'token_api'));
    }

    public function upload(Request $request) {
        $url_api = \App\Parametro::where([
            ['controle', 'CANHOTO'],
            ['empresa_id', \Auth::user()->empresa_id],
            ['tipo', 'API_ENVIA_NOTA'],
        ])->first();

        $nf_canhoto = "";

        $canhoto = $request->nf_canhoto;

        if ($canhoto) {
            if ($canhoto != "" && $canhoto->isValid()) {
                $nf_canhoto = base64_encode(@file_get_contents($canhoto->path()));
            }
        }

        $dados['nf_canhoto'] = $nf_canhoto;

        if ($request->nf_flag) {
            $dados['nf_flag'] = $request->nf_flag;
        }

        $client = new \GuzzleHttp\Client();

        try {
            $response = $client->request("PUT", "{$url_api->parametro}/{$request->nf_id_controle}", [
                'headers' => [
                    'Accept' => "application/json",
                    'Authorization' => "Bearer {$this->token_api}"
                ],
                'json' => $dados
            ]);
        } catch (\GuzzleHttp\Exception\ClientException $e) {
            \Session::flash('flash_message', [
                'msg' => $e->getResponse()->getReasonPhrase(),
                'title' => "StatusCod: {$e->getResponse()->getStatusCode()}",
                'class' => "error",
            ]);

            return back();
        }

        \Session::flash('flash_message', [
            'msg' => "Gravado com sucesso!",
            'title' => "Importação de canhotos",
            'class' => "success",
        ]);

        return back();
    }
}

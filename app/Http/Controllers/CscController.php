<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Http\Requests;

class CscController extends Controller
{
    /**
     * index
     * Exibe a lista de DAPs.
     *
     * @param Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // Verifica parametrização do Portal CSC
        $parametros_csc = \App\Parametro::where([
            ['controle', 'PORTAL_CSC'],
            ['empresa_id', \Auth::user()->empresa_id],
        ])->get();

        $api = [];

        foreach ($parametros_csc as $parametro ) {
            $api[$parametro->tipo] = $parametro->parametro;
        }

        $erro = "";

        if (!array_key_exists('API_URL_DAP', $api)) {
            $erro = $erro != "" ? "{$erro}, API_URL_DAP" : "API_URL_DAP";
        }

        if (!array_key_exists('API_URL_ETAPA', $api)) {
            $erro = $erro != "" ? "{$erro}, API_URL_ETAPA" : "API_URL_ETAPA";
        }

        if (!array_key_exists('API_URL_ITEM', $api)) {
            $erro = $erro != "" ? "{$erro}, API_URL_ITEM" : "API_URL_ITEM";
        }

        if (!array_key_exists('API_URL_VINCULO', $api)) {
            $erro = $erro != "" ? "{$erro}, API_URL_VINCULO" : "API_URL_VINCULO";
        }

        if (!array_key_exists('API_URL_MOTIVO', $api)) {
            $erro = $erro != "" ? "{$erro}, API_URL_MOTIVO" : "API_URL_MOTIVO";
        }

        if ($erro != "") {
            \Session::flash('flash_message', [
                'msg' => "API não parametrizada, contate o administrador ({$erro})!",
                'title' => "Cadastro de Parâmetro",
                'class' => "error",
            ]);

            return redirect('/');
        }

        $motivos = \Requests::get($api['API_URL_MOTIVO'])->body;
        $motivos = json_decode($motivos);

        $email = explode('@', Auth::user()->email);

        $login = $email[0];

        return view('csc.index', compact('api', 'motivos', 'login'));
    }

    /**
     * panorama
     * Exibe a lista de DAPs.
     *
     * @return \Illuminate\Http\Response
     */
    public function panorama() {
        // Verifica parametrização do Portal CSC
        $parametros_csc = \App\Parametro::where([
            ['controle', 'PORTAL_CSC'],
            ['tipo', 'API_URL_PANORAMA'],
            ['empresa_id', \Auth::user()->empresa_id],
        ])->first();

        if (!$parametros_csc) {
            \Session::flash('flash_message', [
                'msg' => "API não parametrizada, contate o administrador (API_URL_PANORAMA)!",
                'title' => "Cadastro de Parâmetro",
                'class' => "error",
            ]);

            return redirect('/');
        }

        $api_url = $parametros_csc->parametro;

        return view('csc.panorama', compact('api_url'));
    }

}

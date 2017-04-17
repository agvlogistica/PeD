<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Http\Requests;

class Portal_fornecedorController extends Controller
{
    public function index(Request $request)
    {

        $nota_fiscal = $request->input('nota_fiscal');
        $pedido = $request->input('pedido');
        $emissao_inicial = $request->input('emissao_inicial');
        $emissao_final = $request->input('emissao_final');
        $previsao_inicial = $request->input('previsao_inicial');
        $previsao_final = $request->input('previsao_final');
        $pagamento_inicial = $request->input('pagamento_inicial');
        $pagamento_final = $request->input('pagamento_final');

        // Verifica se existe o parametro da API configurado
        $url_api = \App\Parametro::where([
            ['controle', 'PORTAl_FORNECEDOR'],
            ['tipo', 'API_NOTAS_FISCAIS'],
        ])->first();

        if (!$url_api) {
            \Session::flash('flash_message', [
                'msg' => "API não parametrizada, contate o administrador!",
                'title' => "Cadastro de Parâmetro",
                'class' => "error",
            ]);

            return redirect('/');
        }

        $cnpj_raiz = Auth::user()->parametros()->where([
            ['controle', 'PORTAL_FORNECEDOR'],
            ['TIPO', 'CNPJ_RAIZ']
        ])->first();

        if (!$cnpj_raiz) {
            \Session::flash('flash_message', [
                'msg' => "CNPJ raiz não cadastrado para o usuário!",
                'title' => "Cadastro de Parâmetro",
                'class' => "error",
            ]);

            return redirect('/');
        }

        $url = $url_api->parametro . "/" . $cnpj_raiz->parametro;
        $url .= "?nota_fiscal=" . $nota_fiscal;
        $url .= "&pedido=" . $pedido;
        $url .= "&emissao_inicial=" . $emissao_inicial;
        $url .= "&emissao_final=" . $emissao_final;
        $url .= "&previsao_inicial=" . $previsao_inicial;
        $url .= "&previsao_final=" . $previsao_final;
        $url .= "&pagamento_inicial=" . $pagamento_inicial;
        $url .= "&pagamento_final=" . $pagamento_final;

        return view('portal_fornecedor.index', compact('url', 'nota_fiscal', 'pedido', 'emissao_inicial', 'emissao_final', 'previsao_inicial', 'previsao_final', 'pagamento_inicial', 'pagamento_final'));
    }
}

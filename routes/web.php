<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::group(['middleware' => 'auth'], function () {
    Route::get('/', function ()    {
        return view('welcome');
    });

    Route::get('lang/{lang}', ['as'=>'lang.switch', 'uses'=>'LanguageController@switchLang']);

    Route::group(['prefix' => 'user'], function() {
        Route::get('index', 'UserController@index')->name('user.index');
        Route::get('create', 'UserController@create')->name('user.create');
        Route::post('store', 'UserController@store')->name('user.store');
        Route::get('edit/{id}', 'UserController@edit')->name('user.edit');
        Route::post('update/{id}', 'UserController@update')->name('user.update');
        Route::get('destroy/{id}', 'UserController@destroy')->name('user.destroy');
        Route::get('profile', 'UserController@profile')->name('user.profile');
    });

    Route::group(['prefix' => 'menu'], function() {
        Route::get('index', 'MenuController@index')->name('menu.index');
        Route::get('create', 'MenuController@create')->name('menu.create');
        Route::post('store', 'MenuController@store')->name('menu.store');
        Route::get('edit/{id}', 'MenuController@edit')->name('menu.edit');
        Route::post('update/{id}', 'MenuController@update')->name('menu.update');
        Route::get('destroy/{id}', 'MenuController@destroy')->name('menu.destroy');
    });

    Route::group(['prefix' => 'grupo'], function() {
        Route::get('index', 'GrupoController@index')->name('grupo.index');
        Route::get('create', 'GrupoController@create')->name('grupo.create');
        Route::post('store', 'GrupoController@store')->name('grupo.store');
        Route::get('edit/{id}', 'GrupoController@edit')->name('grupo.edit');
        Route::post('update/{id}', 'GrupoController@update')->name('grupo.update');
        Route::get('destroy/{id}', 'GrupoController@destroy')->name('grupo.destroy');
    });

    Route::group(['prefix' => 'empresa'], function() {
        Route::get('index', 'EmpresaController@index')->name('empresa.index');
        Route::get('create', 'EmpresaController@create')->name('empresa.create');
        Route::post('store', 'EmpresaController@store')->name('empresa.store');
        Route::get('edit/{id}', 'EmpresaController@edit')->name('empresa.edit');
        Route::post('update/{id}', 'EmpresaController@update')->name('empresa.update');
        Route::get('destroy/{id}', 'EmpresaController@destroy')->name('empresa.destroy');
        Route::post('select', 'EmpresaController@select')->name('empresa.select');
    });

    Route::group(['prefix' => 'acesso'], function() {
        Route::get('index', 'AcessoController@index')->name('acesso.index');
        Route::get('create', 'AcessoController@create')->name('acesso.create');
        Route::post('store', 'AcessoController@store')->name('acesso.store');
        Route::get('edit/{id}', 'AcessoController@edit')->name('acesso.edit');
        Route::post('update/{id}', 'AcessoController@update')->name('acesso.update');
        Route::get('destroy/{id}', 'AcessoController@destroy')->name('acesso.destroy');
    });

    Route::group(['prefix' => 'parametro'], function() {
        Route::get('index', 'ParametroController@index')->name('parametro.index');
        Route::get('create', 'ParametroController@create')->name('parametro.create');
        Route::post('store', 'ParametroController@store')->name('parametro.store');
        Route::get('edit/{id}', 'ParametroController@edit')->name('parametro.edit');
        Route::post('update/{id}', 'ParametroController@update')->name('parametro.update');
        Route::get('destroy/{id}', 'ParametroController@destroy')->name('parametro.destroy');
    });

    Route::group(['prefix' => 'grupo_usuario'], function() {
        Route::get('index', 'Grupo_usuarioController@index')->name('grupo_usuario.index');
        Route::get('create', 'Grupo_usuarioController@create')->name('grupo_usuario.create');
        Route::post('store', 'Grupo_usuarioController@store')->name('grupo_usuario.store');
        Route::get('destroy/{user_id}/{grupo_id}', 'Grupo_usuarioController@destroy')->name('grupo_usuario.destroy');
    });

    Route::group(['prefix' => 'canhoto'], function() {
        Route::get('index', 'CanhotoController@index')->name('canhoto.index');
        Route::get('detalhe/{cte_id}' , 'CanhotoController@detalhe') ->name('canhoto.detalhe');
        Route::post('upload', 'CanhotoController@upload')->name('canhoto.upload');
    });

    Route::group(['prefix' => 'portal_fornecedor'], function() {
        Route::get('index', 'Portal_fornecedorController@index')->name('portal_fornecedor.index');
    });

    //OrderMaker
    Route::group(['prefix' => 'ordermaker'], function() {
        Route::get('importacao','OrderMakerController@importacao')->name('ordermaker.importacao');
        Route::post('importacsv','OrderMakerController@importacsv')->name('ordermaker.importacsv');
        Route::get('geraXml','OrderMakerController@geraXml')->name('ordermaker.geraXml');
        Route::get('interface','OrderMakerController@interface')->name('ordermaker.interface');
        Route::get('listaPedidos','OrderMakerController@listaPedidos')->name('ordermaker.listaPedidos');
        Route::get('interfacestatus','OrderMakerController@interfacestatus')->name('ordermaker.interfacestatus');
    }); //ordermaker

    Route::group(['prefix' => 'csc'], function() {
        Route::get('index', 'CscController@index')->name('csc.index');
        Route::get('panorama', 'CscController@panorama')->name('csc.panorama');
    });

    //Baixa de entrega
    Route::get('baixaentrega', 'ListaNotas@listaNotas')->name('baixaentrega');

    Route::group(['prefix' => 'order_visibility'],function(){
      Route::get('index','OrderVisibilityController@index')->name('order_visibility.index');
      Route::post('recarregaindex','OrderVisibilityController@index')->name('order_visibility.recarregaindex');
      Route::get('recebimento','OrderVisibilityController@recebimento')->name('order_visibility.recebimento');
    });

    Route::get('carregacte/{cte}','ListaNotas@abreCte')->name('carregacte');
    Route::get('ocorrencia/{cte}','ListaNotas@abreOcorrencia')->name('abreocorrencia');
    Route::post('gravainfocte','ListaNotas@gravaInfoCte')->name('gravainfocte');
    Route::post('gravainfocorrencia','ListaNotas@gravaInfOcorrencia')->name('gravainfocorrencia');

    //OrderMaker
    Route::group(['prefix' => 'ordermaker'], function() {
        Route::post('importacsv','OrderMakerController@importacsv')->name('ordermaker.importacsv');
        Route::get('geraXml','OrderMakerController@geraXml')->name('ordermaker.geraXml');
        Route::get('interface','OrderMakerController@interface')->name('ordermaker.interface');
        Route::get('importacao','OrderMakerController@importacao')->name('ordermaker.importacao');
        Route::get('listaPedidos','OrderMakerController@listaPedidos')->name('ordermaker.listaPedidos');
        Route::get('cadastro/prodgrupo', 'OrderMakerController@prodgrupo')->name('ordermaker.prodgrupo');
        Route::get('inclusao/pedido', 'OrderMakerController@pedido')->name('ordermaker.inclusao_pedido');
        Route::get('painel/aprovacao', 'OrderMakerController@aprovacao')->name('ordermaker.painel_aprovacao');
        Route::get('cadastro/cliente', 'OrderMakerController@cliente')->name('ordermaker.cadastro_cliente');
        Route::get('visao/vendas', 'OrderMakerController@visaovendas')->name('ordermaker.visao_vendas');
        Route::post('novopedido', 'OrderMakerController@novopedido')->name('ordermaker.novopedido');
    }); //ordermaker
});

Auth::routes();

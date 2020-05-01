<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('login_facebook','Movil\ApiController@loginFacebook');
Route::get('monto/{order_id}','Movil\ApiController@monto');
Route::post('pedido_transferencia','Movil\ApiController@pedidoTransferencia');
Route::get('zonas','Movil\ApiController@urbanizaciones');
Route::get('pedidos/{id}','Movil\ApiController@pedidos');
Route::get('auth/{email}/{password}', 'Movil\ApiController@auth');
Route::get('datos_formulario/{id}','Movil\ApiController@datosFormulario');
Route::get('categorias','Movil\ApiController@categorias');
Route::get('subcategorias/{id}','Movil\ApiController@subcategorias');
Route::get('productos/{id}','Movil\ApiController@productos');
Route::get('medida/{id}','Movil\ApiController@medida');
Route::get('producto_detalle/{id}','Movil\ApiController@productoDetalle');
Route::get('productosall','Movil\ApiController@allProductos');
Route::get('ofertas','Movil\ApiController@ofertas');
Route::get('consulta','Movil\ApiController@consulta');

<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/con_desempenho', function () {
//     return view('con_desempenho');
// });

Route::get('/con_desempenho/{ids?}', 'DesempenhoController@index');
Route::get('/con_desem_consultor_rela/{ids?}', 'DesempenhoController@relatorio');
Route::get('/con_desem_consultor_grafico/{ids?}', 'DesempenhoController@grafico');
Route::get('/con_desem_consultor_pizza/{ids?}', 'DesempenhoController@graficoPizza');

Route::get('/con_desempenho_cliente/', 'DesempenhoClienteController@index');
Route::get('/con_desem_consultor_rela_cliente/{ids?}', 'DesempenhoClienteController@relatorio');
Route::get('/con_desem_consultor_grafico_cliente/{ids?}', 'DesempenhoClienteController@grafico');
Route::get('/con_desem_consultor_pizza_cliente/{ids?}', 'DesempenhoClienteController@graficoPizza');

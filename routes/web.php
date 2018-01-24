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

use App\Models\Category;
use App\Models\Order;

Route::post('/vendaParcial', 'SellController@vendaParcial');
Route::any('/searchProduct', 'ProductController@search');
Route::post('/associado','SellController@aplicarRemoverDesconto');
Route::post('/cartao','SellController@aplicarRemoverCartao');
Route::post('/admin/generateReport', 'ReportController@generateReport');
Route::post('/admin/analiticReport', 'ReportController@generateAnaliticReport');
Route::get('/admin/report', 'ReportController@index')->name('report');
Route::post('/admin/addStock', 'ProductController@addStock');
Route::get('/admin/stock', 'ProductController@stock')->name('estoque');
Route::get('/removeItem','SellController@removeItem')->name('removeItem');
Route::post('/home', 'SellController@addProducts');
Route::post('/home/cod', 'SellController@codBarra');
Route::post('/criarMesa', 'SellController@criarMesa');
Route::post('/cancelarVenda', 'SellController@cancelarVenda');

Route::get('/home/{id}', function($id){
    $order = Order::find($id);
    $categories = Category::all();
    return view('/home', compact('order', 'categories'));
});

Route::post('/concluirVenda', 'SellController@concluirVenda');

Route::get('/modal/{product_id?}',function($product_id){
    $products = App\Models\Product::all()->where('brand_id', '=', $product_id);
    $brand = App\Models\Brand::find($product_id);
    $sellController = new \App\Http\Controllers\SellController();
    $tableHTML = $sellController->listaProdutosPorMarca($products);
    $resposta = [
        'table' => $tableHTML,
        'name' => $brand->name,
        'id' => $product_id
    ];

    return Response::json($resposta);
});

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('admin')->group(function(){
    Auth::routes();

    Route::group([
        'as'=>'admin.',
        'middleware'=>'auth'
    ], function(){
        Route::resource('categories','CategoryController');
        Route::resource('brands','BrandController');
        Route::resource('products','ProductController');
        Route::resource('clients','ClientController');
        Route::resource('sells', 'SellController');
	    Route::resource('providers', 'ProviderController');
	    Route::resource('bonifications', 'BonificationController');
    });
});

Route::any('/searchOrderHistory', 'OrderHistoryController@search');
Route::get('/history', 'OrderHistoryController@index')->name('history');
Route::get('/historyDetail', 'OrderHistoryController@show')->name('historyDetail');
Route::get('/upload', 'BrandController@upload');
Route::post('/move', 'BrandController@move')->name('move');
Route::get('/home', 'HomeController@index')->name('home');

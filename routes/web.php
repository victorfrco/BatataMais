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


Route::get('/tasks/{task_id?}',function($task_id){
    $products = App\Models\Product::all()->where('brand_id', '=', $task_id);
    $brand = App\Models\Brand::find($task_id);
    $sellController = new \App\Http\Controllers\SellController();
    $tableHTML = $sellController->listaProdutosPorMarca($products);
    $resposta = [
        'table' => $tableHTML,
        'name' => $brand->name,
        'id' => $task_id
    ];

    return Response::json($resposta);
});

Route::post('/tasks',function(Request $request){
    $task = Task::create($request->all());

    return Response::json($task);
});

Route::put('/tasks/{task_id?}',function(Request $request,$task_id){
    $task = Task::find($task_id);

    $task->task = $request->task;
    $task->description = $request->description;

    $task->save();

    return Response::json($task);
});

Route::delete('/tasks/{task_id?}',function($task_id){
    $task = Task::destroy($task_id);

    return Response::json($task);
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
    });
});

Route::get('/home', 'HomeController@index')->name('home');

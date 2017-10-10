<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
*/


Route::group(['prefix' => 'product'], function(){
    Route::get('/', function (){
        $products = App\Models\Product::all();
        return $products;
    });

    Route::get('/create', function (){
        $html = " <h1> Teste </h1>";
        return $html;
    });

    Route::post('/store', function (Request $request){
        return $request;
    });
});

Route::group(['prefix' => 'admin'], function(){
    Route::get('/products', function(){
        $products = App\Models\Product::all();
        if($products->count())
            return $products;
        else
            return "Não possui nenhum produto cadastrado";
    });

    Route::get('/providers', function(){
        $providers = App\Models\Provider::all();

        if ($providers->count())
            return $providers;
        else
            return "Não possui nenhum fornecedor cadastrado";
    });

    Route::get('/brands', function(){
        $brands = App\Models\Brand::all();
        if($brands->count())
            return $brands;
        else
            return "Não possui nenhuma marca cadastrada";
    });

    Route::get('/categories', function(){
        $category = App\Models\Category::all();
        if($category->count())
            return $category;
        else
            return "Não possui nenhuma categoria cadastrada";
    });
});



<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Sell;
use Bootstrapper\Facades\Icon;
use function compact;
use Illuminate\Http\Request;

class SellController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();
        return view('admin.sells.index', compact('categories'));
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
     * @param  \App\Sell  $sell
     * @return \Illuminate\Http\Response
     */
    public function show(Sell $sell)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Sell  $sell
     * @return \Illuminate\Http\Response
     */
    public function edit(Sell $sell)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Sell  $sell
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Sell $sell)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Sell  $sell
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sell $sell)
    {
        //
    }

    public function listaProdutosPorMarca($products = array()){
        $divs = [];
        $divHeader = '<form method="GET" id="form-add-order"></form></form><table class="table table-bordered">
                    <tr>
                        <th>Nome</th>
                        <th style="text-align: center">Estoque</th>
                        <th style="text-align: center">Preço</th>
                        <th style="text-align: center">Quantidade</th>
                    </tr>';
        $divFooter = '</table>';
        foreach ($products as $product){
            $divCont = '<tr>
                        <td>'.$product->name.'
                        </td>
                        <td style="text-align: center">
                        '.$product->qtd.'
                        </td>
                        <td style="text-align: center">R$ '.$product->price_resale.'
                        </td>
                        <td style="text-align: center" form="form-add-order">'. \Bootstrapper\Facades\Button::appendIcon(Icon::plus())->withAttributes(
                    ['class' => 'btn btn-xs', 'onclick' => "myFunction1($product->id)"]) .' &nbsp;&nbsp;  
                                <input style="width: 50px" type="number" id="quantidade'.$product->id.'" min="0" max="'.$product->qtd.'"> &nbsp;&nbsp;'.
                \Bootstrapper\Facades\Button::appendIcon(Icon::minus())->withAttributes(
                    ['class' => 'btn btn-xs', 'onclick' => "myFunction2($product->id)"]).'
                                
                        </td>
                        </tr>';
            array_push($divs, $divCont);
        }
        $string = implode($divs);
        $table = $divHeader.$string.$divFooter;

        return $table;
    }
}

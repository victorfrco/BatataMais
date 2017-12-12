<?php
/**
 * Created by PhpStorm.
 * User: victor.oliveira
 * Date: 12/12/2017
 * Time: 16:15
 */

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Order;
use function array_push;
use Button;
use function compact;
use function implode;

class OrderController extends Controller
{
    public function carregaPedidosAbertos(){
        $pedidos = Order::all()->where('status','=', '4');
        $listaDeDivs = $this->criaListaPedidos($pedidos);
        return implode($listaDeDivs);
    }

    public function criaListaPedidos($pedidos){
        $lista =[];
        $categories = Category::all();
        foreach ($pedidos as $order) {
            $div = Button::success()->withAttributes([
                        'id' => $order->id,
                        'style' =>
                                   'width: 100px;
                                   height: 40px;
                                   font-size: 12px;
                                   font-weight:bold;
                                   text-align: center;'
            ])->asLinkTo('/home/'.$order->id, compact('order'));
            array_push($lista, $div);
        }
        return $lista;
    }
}
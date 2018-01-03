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
use function asort;
use Button;
use function compact;
use function implode;

class OrderController extends Controller
{
    public function carregaPedidosAbertos(){
        $pedidos = Order::all()->where('status','=', '2');
        $listaDeDivs = $this->criaListaPedidos($pedidos);
        return implode($listaDeDivs);
    }

    public function criaListaPedidos($pedidos){
        $lista =[];
        $categories = Category::all();
        foreach ($pedidos as $order) {
            $div = Button::primary($order->client->name)->withAttributes([
                        'id' => $order->id,
                        'style' =>
                                   'min-width: 100px;
                                   height: 40px;
                                   font-size: 12px;
                                   font-weight:bold;
                                   text-align: center;
                                   line-height: 28px;
                                   margin-right: 10px'
            ])->asLinkTo('/home/'.$order->id, compact('order'));
            array_push($lista, $div);
        }
        return $lista;
    }
}
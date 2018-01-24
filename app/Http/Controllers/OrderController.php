<?php
/**
 * Created by PhpStorm.
 * User: victor.oliveira
 * Date: 12/12/2017
 * Time: 16:15
 */

namespace App\Http\Controllers;

use App\Models\Bonification;
use App\Models\Category;
use App\Models\Item;
use App\Models\Order;
use App\Models\Product;
use function array_push;
use function asort;
use Button;
use function compact;
use Illuminate\Support\Facades\DB;
use function implode;

class OrderController extends Controller
{
    public function carregaPedidosAbertos(){
        $pedidos = Order::all()->whereIn('status', [2,5]);
        $listaDeDivs = $this->criaListaPedidos($pedidos);
        return implode($listaDeDivs);
    }

    public function criaListaPedidos($pedidos){
        $lista =[];
        $categories = Category::all();
        foreach ($pedidos as $order) {
            $div = Button::primary($order->client->nickname)->withAttributes([
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

    public static function itensFormatados($order_id){
    	$produtoQtd = [];
	    $itens = Item::all()->where('order_id', '=', $order_id);
	    foreach ( $itens as $item ) {
		    $product = Product::find($item->product_id);
		    $p[0] = $product->name;
		    $p[1] = $item->qtd;
		    $p[2] = $item->total / $item->qtd;
		    array_push($produtoQtd, $p);
		}
		return $produtoQtd;
    }

    public static function possuiPagamento(Order $order){
        $subOrders = $order->getSubOrders();
        $possui = false;
        if($subOrders != null && $subOrders->count() > 0){
            foreach ($subOrders as $subOrder){
                if($subOrder->pay_method == 4) {
                    $possui = true;
                }
            }
        }
        return $possui;
    }

	public static function valorPago(Order $order){
		$subOrders = $order->getSubOrders();
		$total = 0;
		if($subOrders != null && $subOrders->count() > 0){
			foreach ($subOrders as $subOrder){
				if($subOrder->pay_method == 4)
					$total += $subOrder->total;
			}
		}
		return $total;
	}

	public static function valorTotalSubVendas(Order $order){
		$subOrders = $order->getSubOrders();
		$total = 0;
		if($subOrders != null && $subOrders->count() > 0){
			foreach ($subOrders as $subOrder){
					$total += $subOrder->total;
			}
		}
		return $total;
	}

	public static function vendasRecentesOriginaisPagas(){
		$orders = DB::table('orders')->whereNull('original_order')->orderByDesc('updated_at')->get();
		return $orders;
	}

	public static function possuiBonificacao($order){
		$bonificacoes = Bonification::all()->where('order_id','=', $order->id)->count();
		if($bonificacoes > 0)
			return true;
		else
			return false;
	}

	public static function bonificacoes($order){
		$bonificacoes = Bonification::all()->where('order_id','=', $order->id);
		return $bonificacoes;
	}
}
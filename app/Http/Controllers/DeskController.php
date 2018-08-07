<?php

namespace App\Http\Controllers;

use App\Desk;
use App\Models\Category;
use App\Models\Order;
use Bootstrapper\Facades\Button;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DeskController extends Controller
{
    public function carregaMesas(){
        $pedidos = Desk::all()->where('status', '=', 1);
        $listaDeDivs = $this->criaListaMesas($pedidos);
        return implode($listaDeDivs);
    }

    public function criaListaMesas($pedidos){
        $lista =[];
        $categories = Category::all()->where('status','=',1);
        foreach ($pedidos as $desk) {
            if ($desk->order_id != null) {
                $order = $desk->order_id;
                $div = Button::primary($desk->name)->withAttributes([
                    'id' => $desk->id,
                    'style' =>
                        'min-width: 100px;
                                       height: 40px;
                                       font-size: 12px;
                                       font-weight:bold;
                                       text-align: center;
                                       line-height: 28px;
                                       margin-right: 10px'
                ])->asLinkTo('/home/' . $desk->order_id, compact('order'));
            }else{
                $div = Button::success($desk->name)->withAttributes([
                    'id' => $desk->id,
                    'class' => 'darken-2',
                    'style' =>
                        'min-width: 100px;
                                       height: 40px;
                                       font-size: 12px;
                                       font-weight:bold;
                                       text-align: center;
                                       line-height: 28px;
                                       margin-right: 10px',
                    'data-toggle' => 'modal',
                    'data-target' => '#vincularVendaMesa',
                    'data_desk_id' => $desk->id
                ]);
            }
            array_push($lista, $div);
        }
        return $lista;
    }

    public function vincularMesa(Request $request){
        $desk_id = $request->get('desk_id');
        $order_id = $request->get('order_id');
        $order = Order::find($order_id);
        $desk = Desk::find($desk_id);
        $desk->order_id = $order_id;
        $desk->status = 2;
        $desk->save();

        $order->status = 1; // STATUS_MESA
        $order->update();


        $categories = Category::all()->where('status','=',1);
        return redirect('home')->with(compact('order', 'categories'));

    }

    public function criarMesaVenda(Request $request){
        $desk_id = $request->get('desk_id');
        return $this->criarVenda($desk_id);
    }

    public function criarVenda($desk_id){
        $sellcontroller = new SellController();
        $order = new Order();
        $order->client_id = 3; // cliente "MESA"
        $order->total = 0;
        $order->absolut_total = 0;
        $order->discount = 0;
        $order->status = $sellcontroller->getSTATUSMESA();
        $order->type = 2;
        $order->associated = 0;
        $order->user_id = Auth::user()->id;
        $order->save();

        //vincular a nova venda à mesa selecionada
        $desk = Desk::find($desk_id);
        $desk->order_id = $order->id;
        $desk->update();

        $categories = Category::all()->where('status','=',1);
        return redirect('home')->with(compact('order', 'categories'));
    }

    public function create(){
        $desk = new Desk();
        $desk->status = 1;

        $cont = Desk::all()->where('status', '=',1)->max('cont');
        if($cont != null)
            $desk->cont = $cont+1;
        else
            $desk->cont = 1;

        $desk->name = 'Mesa '.$desk->cont;
        $desk->save();
        //registrar historico todo
    }
}

<?php

namespace App\Http\Controllers;

use App\Desk;
use App\DeskHistory;
use App\Models\Category;
use App\Models\Order;
use Bootstrapper\Facades\Button;
use Bootstrapper\Facades\ButtonGroup;
use Bootstrapper\Facades\Icon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DeskController extends Controller
{
    public function carregaMesas(){
        $pedidos = Desk::all()->where('status', '=', 1);
        foreach ($pedidos as $pedido){
            $pedido = Desk::find($pedido->id);
            if($pedido->order_id != null){
                $order = Order::find($pedido->order_id);
                if($order->status == 1 || $order->status == 3) {
                    $pedido->order_id = null;
                    $pedido->update();
                }
            }
        }
        $pedidos = Desk::all()->where('status', '=', 1);
        //limpa as mesas de vendas concluidas e canceladas
        $listaDeDivs = $this->criaListaMesas($pedidos);
        return implode($listaDeDivs);
    }

    public function criaListaMesas($pedidos){
        $lista =[];
        $categories = Category::all()->where('status','=',1);
        foreach ($pedidos as $desk) {
            if ($desk->order_id != null) {
                $order = Order::find($desk->order_id);
                if($order->absolut_total > 250){
                    $div = Button::danger($desk->name)->withAttributes([
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
                }else {
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
                }
            }else{
                $div = ButtonGroup::withContents([
                    Button::success($desk->name)->withAttributes([
                        'id' => $desk->id,
                        'class' => 'darken-2',
                        'style' =>
                            'min-width: 80px;
                                       height: 40px;
                                       font-size: 12px;
                                       font-weight:bold;
                                       text-align: center;
                                       line-height: 28px;',
                        'data-toggle' => 'modal',
                        'data-target' => '#vincularVendaMesa',
                        'data_desk_id' => $desk->id
                    ]),
                    Button::danger('X')->withAttributes([
                        'id' => $desk->id,
                        'class' => 'darken-2',
                        'style' =>
                            'width: px;
                                       height: 40px;
                                       background-color:black;
                                       color:red;
                                       font-size: 12px;
                                       font-weight:bold;
                                       text-align: left;
                                       line-height: 28px;
                                       margin-right: 10px',
                        'data-toggle' => 'modal',
                        'data-target' => '#excluirMesa',
                        'data_desk_id' => $desk->id
                    ]),
                ]);
            }
            array_push($lista, $div);
        }
        return $lista;
    }

    public function vincularMesa(Request $request){
        $sellcontroller = new SellController();
        $desk_id = $request->get('desk_id');
        $order_id = $request->get('order_id');
        $order = Order::find($order_id);
        $desk = Desk::find($desk_id);
        $desk->order_id = $order_id;
        $desk->status = 1;
        $desk->save();

        $order->status = $sellcontroller->getSTATUSMESA(); // STATUS_MESA
        $order->type = 2;
        $order->update();

        $deskcontroller = new DeskHistoryController();
        $history = new DeskHistory();
        $history->desk_id = $desk->id;
        $history->user_id = Auth::id();
        $history->order_id = $order->id;
        $history->status = $deskcontroller->getSTATUSVINCULANDO();

        $history->save();

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

        $history = new DeskHistory();
        $history->desk_id = $desk->id;
        $history->user_id = Auth::id();
        $history->order_id = $order->id;
        $deskcontroller = new DeskHistoryController();
        $history->status = $deskcontroller->getSTATUSVINCULANDO();
        $history->save();

        $categories = Category::all()->where('status','=',1);
        return redirect('home')->with(compact('categories'));
    }

    public function create(){
        $desk = new Desk();
        $desk->status = 1;
        $desk->user_id = Auth::id();
        $cont = Desk::all()->where('status', '=',1)->max('cont');
        if($cont != null)
            $desk->cont = $cont+1;
        else
            $desk->cont = 1;

        $desk->name = 'Mesa '.$desk->cont;
        $desk->save();
        //registrar historico todo
    }

    public function createDesk(){
        $this->create();

        $categories = Category::all()->where('status','=',1);
        return redirect('home')->with(compact('categories'));
    }

    public function excluirMesa(Request $request){
        $desk = Desk::find($request->get('desk_id'));
        $desk->status = 2;
        $desk->update();

        //registrar no historico todo

        $categories = Category::all()->where('status','=',1);
        return redirect('home')->with(compact('order', 'categories'));
    }
}

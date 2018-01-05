<?php

namespace App\Models;

use Bootstrapper\Facades\Button;
use Bootstrapper\Facades\Icon;
use Illuminate\Database\Eloquent\Model;

class Sell extends Model
{
    public static function atualizaTabelaDeItens($order_id)
    {
        $order = Order::find($order_id);
        $itens = Item::all()->where('order_id', '=', $order_id);
        $tableHeader = '<table class="table" style="font-size: 13px">
                            <tr>
                                <th>Descrição</th>
                                <th>Quantidade</th>
                                <th>Valor Unid.</th>
                                <th>Valor Total</th>
                                <th style="text-align: center">'.Icon::remove().'</th>
                            </tr>';
        $tableCont = [];
        foreach ($itens as $item){
            $product = Product::find($item->product_id);
            if($order->associated == 1)
                $price = $product->price_discount;
            else
                $price = $product->price_resale;


            $tupla = '      <tr>
                                <td align="left">'.$product->name.'</td>
                                <td align="right">'.$item->qtd.'</td>
                                <td align="right">'.$price.'</td>
                                <td align="right">'.number_format((float)$item->total, 2, '.', '').'</td>
                                <td align="center">'.Button::link(Icon::remove())->asLinkTo(route('removeItem', ['item' => $item])).'</td>
                            </tr>';
            array_push($tableCont, $tupla);
        }
        $tableFooter = '</table>';
        $tableCont = implode($tableCont);
        $string = $tableHeader.$tableCont.$tableFooter;
        return $string;
    }

}

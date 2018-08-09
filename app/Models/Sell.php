<?php

namespace App\Models;

use Bootstrapper\Facades\Button;
use Bootstrapper\Facades\Icon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Sell extends Model
{
    public static function atualizaTabelaDeItens($order_id)
    {
        $order = Order::find($order_id);
        $itens = DB::table('itens')->select('*')->where('order_id','=',$order_id)->orderByDesc('updated_at')->get()->toArray();
        $itens = Item::hydrate($itens);
        $tableHeader = '<table class="table" style="font-size: 13px">
                            <tr>
                                <th>Descrição</th>
                                <th style="text-align: center;">Qtd.</th>
                                <th style="text-align: center;">Valor Unid.</th>
                                <th style="text-align: center;">Valor Total</th>
                                <th style="text-align: center; color: #2a88bd; font-size: 15px">'.Icon::remove().'</th>
                            </tr>';
        $tableCont = [];
        foreach ($itens as $item){
            $product = Product::find($item->product_id);
            if($order->associated == 1)
                $price = $product->price_discount;
            else if($order->pay_method == 3)
                $price = $product->price_card;
            else
                $price = $product->price_resale;


            $tupla = '      <tr>
                                <td style="vertical-align: middle" align="left">'.$product->name.'</td>
                                <td align="center" style="vertical-align: middle">'.$item->qtd.'</td>
                                <td align="center" style="vertical-align: middle; text-shadow: 1px 1px #ffcc00; color: #ffffff;">'.number_format($price, 2, ',', '.').'</td>
                                <td align="center" style="vertical-align: middle; text-shadow: 1px 1px #ffcc00; color: #ffffff;">'.number_format($item->total, 2, ',', '.').'</td>
                                <td align="center" style="vertical-align: middle">'.Button::link(Icon::remove())->asLinkTo(route('removeItem', ['item' => $item])).'</td>
                            </tr>';
            array_push($tableCont, $tupla);
        }
        $tableFooter = '</table>';
        $tableCont = implode($tableCont);
        $string = $tableHeader.$tableCont.$tableFooter;
        return $string;
    }

    public static function converteMoedaParaDecimal($valor)
    {
        if($valor != "") {
            $teste = trim($valor, 'R\$\ ');
            $teste = str_replace('.', '', $teste);
            $teste = str_replace(',', '.', $teste);
            if ($valor[0] === '.')
                $teste = '0' . $teste;
            return $teste;
        }
    }

}

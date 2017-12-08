<?php

namespace App\Models;

use function dd;
use Illuminate\Database\Eloquent\Model;

class Sell extends Model
{
    public static function atualizaTabelaDeItens($order_id)
    {
        $itens = Item::all()->where('order_id', '=', $order_id);
        $tableHeader = '<table class="table">
                            <tr>
                                <th>Descrição</th>
                                <th>Quantidade</th>
                                <th>Valor Unid.</th>
                                <th>Valor Total</th>
                            </tr>';
        $tableCont = [];
        foreach ($itens as $item){
            $product = Product::find($item->product_id);
            $tupla = '      <tr>
                                <td align="left">'.$product->name.'</td>
                                <td align="right">'.$item->qtd.'</td>
                                <td align="right">'.$product->price_resale.'</td>
                                <td align="right">'.$item->total.'</td>
                            </tr>';
            array_push($tableCont, $tupla);
        }
        $tableFooter = '</table>';
        $tableCont = implode($tableCont);
        $string = $tableHeader.$tableCont.$tableFooter;
        return $string;
    }

}

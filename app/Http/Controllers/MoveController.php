<?php
/**
 * Created by PhpStorm.
 * User: victor.oliveira
 * Date: 17/01/2018
 * Time: 14:51
 */

namespace App\Http\Controllers;


use App\Models\Bonification;
use App\Models\Item;
use App\Models\Move;
use App\Models\Order;
use App\Models\Product;
use Auth;

class MoveController {
	/**
	 * @param $status
	 * @param $product_id
	 * @param $qtd
	 * @param $vlr
	 * @param $client_id
	 * @param $user_id
	 */
	private function salvaMovimentacao($status, $product_id, $qtd, $vlr, $client_id, $user_id){
		$movimento = new Move();
		$movimento->status = $status;
		$movimento->product_id = $product_id;
		$movimento->qtd = $qtd;
		$movimento->vlrUnit = $vlr;
		$movimento->client_id = $client_id;
		$movimento->user_id = $user_id;

		$movimento->save();
	}

	/**
	 * @param Order $order
	 * @param $status
	 */
	public function registraBaixaTotal(Order $order, $status){
		$itens = Item::all()->where('order_id', '=', $order->id);
		foreach($itens as $item){
			$product = Product::find($item->product_id);
			$valor = $item->total/$item->qtd;
			$this->salvaMovimentacao($status, $product->id, $item->qtd, $valor, $order->client_id, Auth::id());
		}
	}

	/**
	 * @param Bonification $bonification
	 * @param $status
	 */
	public function registraBonificacao(Bonification $bonification, $status){
		$item = Item::find($bonification->item_id);
		$product = Product::find($item->product_id);
		$this->salvaMovimentacao($status, $product->id, $item->qtd, $product->price_cost, $bonification->client_id, Auth::id());
	}

	/**
	 * @param $product
	 * @param $qtd
	 * @param $status
	 */
	public function registraEntradaIndividual($product, $qtd, $status){
		$this->salvaMovimentacao($status, $product->id, $qtd, $product->price_cost, null, Auth::id());
	}

    public function registraSaidaIndividual($product, $qtd, $status)
    {
        $this->salvaMovimentacao($status, $product->id, $qtd, $product->price_cost, null, Auth::id());
    }
}
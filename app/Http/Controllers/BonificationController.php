<?php
/**
 * Created by PhpStorm.
 * User: victor.oliveira
 * Date: 17/01/2018
 * Time: 08:42
 */

namespace App\Http\Controllers;


use App\Models\Bonification;
use App\Models\Item;
use App\Models\Order;
use App\Models\Product;
use Auth;
use Illuminate\Http\Request;
use function redirect;

class BonificationController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		$bonifications = Bonification::orderBy('updated_at', 'desc')->paginate(6);
		return view('admin.bonifications.index', compact('bonifications'));
	}

	public function store(Request $request)
	{
		$order = Order::find($request->get('order_id'));
		$quantidade = $request->get('product_qtd');
		$product = Product::find($request->get('product_id'));
		$product->qtd -= $quantidade;

		$item = new Item();
		$item->product_id = $product->id;
		$item->qtd = $quantidade;
		$item->total = $quantidade * $product->price_cost;

		$product->update();
		$item->save();

		$bonificacao = new Bonification();
		$bonificacao->item_id = $item->id;
		$bonificacao->client_id = $order->client_id;
		$bonificacao->order_id = $order->id;
		$bonificacao->user_id = Auth::id();

		$bonificacao->save();

		$moveController = new MoveController();
		$moveController->registraBonificacao($bonificacao, 2);

		return redirect()->back();
	}
}
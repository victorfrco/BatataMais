<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Support\Facades\Input;
use Table;

class OrderHistoryController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		$orders = Order::select()->whereNull('original_order')->orderBy('updated_at', 'desc')->paginate(6);

		return view('admin.history.index', compact('orders'));
	}

	public function show()
	{
		$order = Order::find($_GET)->first();
		return view('admin.history.show', compact('order'));
	}

	public function search(){
		$q = Input::get ( 'q' );
		if($q != ""){
			$orders = Order::where ( 'id', 'LIKE', $q . '%' )->paginate (6)->setPath ( '' );
			$pagination = $orders->appends ( array (
				'q' => Input::get ( 'q' )
			) );
			if (count ( $orders ) > 0)
				return view('admin.history.index', compact('orders'));
		}
		return view ( 'admin.history.index' )->withMessage('Nenhuma venda encontrada para "'.$q.'"...' );
	}

	public static function exibeDetalhes(Order $order){
		$dados = [];
		$dados['dataDeCriacao'] = $order->getDataFormatada();
		$dados['ultimaAtualizacao'] = $order->getUltimaAtualizacao();
		$dados['possuiSubOrder'] = $order->verificaSubOrder($order);
		$dados['usuarioResponsavel'] = $order->getNomeUsuario();
		$dados['vlrTotal'] = $order->absolut_total;
		$dados['vlrDesconto'] = $order->discount;
		$dados['formaDePagamento'] = $order->getFormaDePagamento();
		$dados['subOrders'] = $order->getSubOrders();
		$dados['nomeCliente'] = $order->getNomeCliente();
		$dados['apelidoCliente'] = $order->getApelidoCliente();


		return $dados;
	}
}

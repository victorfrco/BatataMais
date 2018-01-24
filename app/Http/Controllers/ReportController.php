<?php

namespace App\Http\Controllers;

use App;
use Barryvdh\DomPDF\Facade as PDF;
use function compact;
use \Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use function redirect;
use function route;
use function view;

class ReportController extends Controller
{
	public function index(){
		return view('admin.reports.index');
	}

	public function generateAnaliticReport(Request $request){
		$date  = $request->toArray()['date'];
		$dados = $this->buscaEntradasESaidas( $date );
		if ($dados['entradas']->count() == 0 && $dados['saidas']->count() == 0) {
			$request->session()->flash('message', 'Não existe nenhuma entrada ou saída na data informada!');
			return redirect()->route('report');
		} else {
			$pdf = PDF::loadView( 'admin.reports.analitic', compact( 'dados' ) );
			return $pdf->download( 'Entradas e Saidas_' . $dados['data'] . '.pdf' );
		}
	}

	public function generateReport(Request $request) {
		$date  = $request->toArray()['date'];
		$dados = $this->buscaDadosPorData( $date );

		if ( $dados['maisVendido'] != null ) {
			$pdf = PDF::loadView( 'admin.reports.show', compact( 'dados' ) );

			return $pdf->download( 'Relatorio_Sintetico_' . $dados['data'] . '.pdf' );
		} else {
			$request->session()->flash('message', 'Não existe nenhuma venda CONCLUÍDA na data informada!');
			return redirect()->route('report');
		}
	}

	private function buscaDadosPorData($date) {
		$dados = [];
		$dataFormatada = new \DateTime($date);
		$dados['data'] = $dataFormatada->format('d-m-Y');
		$dados['totalDeVendas'] = DB::table('orders')->whereDate('created_at','=', $date)->count();
		$dados['vlrTotalDeVendas'] = DB::table('orders')->whereDate('created_at','=', $date)->sum('total');


		$dados['totalDeVendasFinalizadas'] = DB::table('orders')->where('status', '=', 3)
		                                       ->whereDate('created_at','=', $date)->count();
		$dados['vlrTotalDeVendasFinalizadas'] = DB::table('orders')->where('status', '=', 3)
		                                          ->whereDate('created_at','=', $date)->sum('total');


		$dados['totalDeMesasEmAberto'] = DB::table('orders')->where('status', '=', 2)
		                                   ->whereDate('created_at','=', $date)->count();
		$dados['vlrTotalDeMesasEmAberto'] = DB::table('orders')->where('status', '=', 2)
		                                      ->whereDate('created_at','=', $date)->sum('total');


		$dados['totalDeVendasEmAberto'] = DB::table('orders')->where('status', '=', 4)
		                                    ->whereDate('created_at','=', $date)->count();
		$dados['vlrTotalDeVendasEmAberto'] = DB::table('orders')->where('status', '=', 4)
		                                       ->whereDate('created_at','=', $date)->sum('total');


		$dados['totalDeVendasCanceladas'] = DB::table('orders')->where('status', '=', 1)
		                                      ->whereDate('created_at','=', $date)->count();
		$dados['vlrTotalDeVendasCanceladas'] = DB::table('orders')->where('status', '=', 1)
		                                         ->whereDate('created_at','=', $date)->sum('total');

		$dados['qtdVendasDinheiro'] = DB::table('orders')->where('pay_method', '=', 0)
		                                ->whereDate('created_at','=', $date)->count();
		$dados['vlrVendasDinheiro'] = DB::table('orders')->where('pay_method', '=', 0)
		                                ->whereDate('created_at','=', $date)->sum('total');


		$dados['qtdVendasDebito'] = DB::table('orders')->where('pay_method', '=', 1)
		                              ->whereDate('created_at','=', $date)->count();
		$dados['vlrVendasDebito'] = DB::table('orders')->where('pay_method', '=', 1)
		                              ->whereDate('created_at','=', $date)->sum('total');


		$dados['qtdVendasCredito'] = DB::table('orders')->where('pay_method', '=', 2)
		                               ->whereDate('created_at','=', $date)->count();
		$dados['vlrVendasCredito'] = DB::table('orders')->where('pay_method', '=', 2)
		                               ->whereDate('created_at','=', $date)->sum('total');

		$dados['vendasPorUsuario'] = DB::table('orders')
		                               ->join('users', 'orders.user_id', '=', 'users.id')
		                               ->select(DB::raw('users.name as user_id, sum(orders.total) as vlr, count(*) as qtd'))
		                               ->where('orders.status','=',3)
		                               ->where('orders.total','>',0)
		                               ->whereDate('orders.created_at', '=', $date)
		                               ->groupBy('users.name')
		                               ->get();

		$dados['maisVendido'] = DB::table('itens')
		                          ->join('orders', 'itens.order_id', '=', 'orders.id')
		                          ->join('products', 'itens.product_id', '=', 'products.id')
		                          ->select(DB::raw('products.name as nome, count(*) as qtd'))
		                          ->where('orders.status', '=', 3)
		                          ->where('orders.total','>',0)
		                          ->whereDate('orders.created_at','=', $date)
		                          ->groupBy('products.name')
		                          ->orderByDesc('qtd')
		                          ->first();

		$dados['valorMedio'] = DB::table('orders')
		                         ->where('status', '=', 3)
		                         ->whereDate('created_at','=', $date)
		                         ->avg('total');
//		return dd($dados);
		return $dados;
	}

	private function buscaEntradasESaidas($date)
	{
		$dados = [];
		$dataFormatada = new \DateTime($date);
		$dados['data'] = $dataFormatada->format('d-m-Y');

		/*SELECT P.ID, P.name, SUM(M.qtd) AS QTD, M.vlrUnit, (M.vlrUnit * SUM(M.qtd)) AS total FROM moves M
		JOIN products P ON M.product_id = P.ID WHERE M.STATUS = 2
  GROUP BY p.id, M.vlrUnit;*/
		$dados['saidas'] = DB::table('moves')
		                     ->join('products', 'moves.product_id', '=', 'products.id')
		                     ->select(DB::raw('products.id, SUM(moves.qtd) AS qtd, moves.vlrUnit, (moves.vlrUnit * SUM(moves.qtd)) AS total,  products.name'))
		                     ->where('moves.status', '=', 2)
		                     ->whereDate('moves.updated_at','=', $date)
		                     ->groupBy('products.id', 'products.name','moves.vlrUnit')
		                     ->get();

		$dados['entradas'] = DB::table('moves')
		                       ->join('products', 'moves.product_id', '=', 'products.id')
		                       ->select(DB::raw('products.id, SUM(moves.qtd) AS qtd, moves.vlrUnit, (moves.vlrUnit * SUM(moves.qtd)) AS total,  products.name'))
		                       ->where('moves.status', '=', 1)
		                       ->whereDate('moves.updated_at','=', $date)
		                       ->groupBy('products.id', 'products.name','moves.vlrUnit')
		                       ->get();

//		return dd($dados);
		return $dados;
	}
}

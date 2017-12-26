<?php

namespace App\Http\Controllers;

use \Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use function view;

class ReportController extends Controller
{
    public function index(){
    	return view('admin.reports.index');
    }

    public function generateReport(Request $request){
        $date = $request->toArray()['date'];
        $dados = $this->buscaDadosPorData($date);

        return view('admin.reports.show', compact('dados'));
    }

	private function buscaDadosPorData($date) {
    	$dados = [];

    	$dados['data'] = $date;
		$dados['totalDeVendas'] = DB::table('orders')->whereDate('created_at','=', $date)->count();
		$dados['vlrTotalDeVendas'] = DB::table('orders')->whereDate('created_at','=', $date)->sum('total');


		$dados['totalDeVendasFinalizadas'] = DB::table('orders')->where('status', '=', 3)
		                                                              ->whereDate('created_at','=', $date)->count();
		$dados['vlrTotalDeVendasFinalizadas'] = DB::table('orders')->where('status', '=', 3)
		                                                ->whereDate('created_at','=', $date)->sum('total');


		$dados['totalDeVendasEmAberto'] = DB::table('orders')->where('status', '=', 2)
		                                          ->whereDate('created_at','=', $date)->count();
		$dados['vlrTotalDeVendasEmAberto'] = DB::table('orders')->where('status', '=', 2)
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

		$dados['vendasPorUsuario'] = DB::table('orders')->select('id', 'total', 'pay_method')->get();

//		return dd($dados);
		return $dados;
	}
}

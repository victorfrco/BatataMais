<?php

namespace App\Http\Controllers;

use App\CashMoves;
use App\Desk;
use App\Models\Cash;
use App\Models\Category;
use App\Models\Client;
use App\Models\Order;
use App\Models\Sell;
use App\User;
use function array_key_exists;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Redirect;

class CashController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    	//status 1 = EM_ABERTO
	    $caixa = $this->buscaCaixaPorUsuario(Auth::id());
	    return view('admin.cashes.index', compact('caixa'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
	    $cash = new Cash();
	    $cash->user_id = Auth::id();

	    $valor = $request->get('inicial_value');
	    $mesas = $request->get('desks');

	    $valor = Sell::converteMoedaParaDecimal($valor);
	    $cash->inicial_value = $valor;
	    $cash->status = 1;
	    $cash->opened_at = new DateTime();
	    $cash->save();

	    $deskController = new DeskController();
	    if($mesas != null && $mesas > 0){
	        for ($i = 0; $i < $mesas; $i++)
                $deskController->create();
        }

	    $caixa = Cash::find($cash->id);
	    return view('admin.cashes.index', compact('caixa'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cash  $cash
     * @return \Illuminate\Http\Response
     */
    public function show(Cash $cash)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Cash  $cash
     * @return \Illuminate\Http\Response
     */
    public function edit(Cash $cash)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cash  $cash
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cash $cash)
    {
	    //
    }

    public function fecharCaixa(Request $request){
	    $cash = Cash::find($request->get('cash_id'));

        //validar se não existe venda em aberto
        // limpar todas as mesas - STATUS 2
        $pedidos = Order::all()->whereIn('status', [2,4,5])->where('user_id','=', Auth::id());
        if($pedidos != null && $pedidos->isNotEmpty()){
            flash()->overlay('Não foi possível fechar o caixa. Existem vendas em aberto!','Erro!');
            return redirect()->route('admin.cashes.index');
        }

        $mesas = Desk::all()->where('status',  '=', 1)->where('user_id','=', Auth::id());
        foreach ($mesas as $mesa){
            $mesa->status = 2;
            $mesa->update();
        }
        $cash->closed_at = new DateTime();
	    $cash->status = 2;
	    $cash->final_value = $cash->inicial_value + $cash->atual_value;

	    if(array_key_exists('obs', $request->toArray()))
	    	$cash->obs = $request->get('obs');

	    $cash->update();

        return redirect()->route('home');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cash  $cash
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cash $cash)
    {
        //
    }

	public static function buscaCaixaPorUsuario( $user_id ) {
		return Cash::all()->where('user_id', '=', $user_id)->where('status', '=', 1)->first();
	}

    public function novaEntrada(Request $request){
//        dd($request->toArray());
        $valor = Sell::converteMoedaParaDecimal($request->get('novaEntradaValor'));
        $movimentacao = new CashMoves();
        $movimentacao->total = $valor;
        $movimentacao->type = CashMoves::getTIPOENTRADA();
        $movimentacao->obs = $request->get('novaEntradaObs');
        $movimentacao->user_id = Auth::id();
        $movimentacao->cash_id = $request->get('cash_id');
        $movimentacao->save();

        $request->session()->flash('message', 'Entrada registrada com sucesso!');
        return redirect()->route('admin.cashes.index');
    }

    public function novaSaida(Request $request){
        $valor = Sell::converteMoedaParaDecimal($request->get('novaSaidaValor'));
        $movimentacao = new CashMoves();
        $movimentacao->total = $valor;
        $movimentacao->type = CashMoves::getTIPOSAIDA();
        $movimentacao->obs = $request->get('novaSaidaObs');
        $movimentacao->user_id = Auth::id();
        $movimentacao->cash_id = $request->get('cash_id');
        $movimentacao->save();

        $request->session()->flash('message', 'Saída registrada com sucesso!');
        return redirect()->route('admin.cashes.index');
    }

    public static function buscaEntradas($id){
        $entradas = CashMoves::all()->where('cash_id','=', $id)->where('type','=', CashMoves::getTIPOENTRADA());
        $itens = array();
        foreach ($entradas as $entrada){
            $item['usuario'] =  User::find($entrada->user_id)->email;
            $item['valor'] = $entrada->total;
            $dataFormatada = new \DateTime($entrada->created_at);
            $item['datahora'] = $dataFormatada->format('d/m/Y H:i');
            $item['obs'] = $entrada->obs;
            array_push($itens, $item);
        }
        return CashController::montaTabelaEntradaSaida($itens);
    }

    public static function buscaSaidas($id){
        $saidas = CashMoves::all()->where('cash_id','=', $id)->whereIn('type',[CashMoves::getTIPOSAIDA(),CashMoves::getTIPODESCONTO()]);
        $itens = array();
        foreach ($saidas as $saida){
            $item['usuario'] =  User::find($saida->user_id)->email;
            $item['valor'] = $saida->total;
            $dataFormatada = new \DateTime($saida->created_at);
            $item['datahora'] = $dataFormatada->format('d/m/Y H:i');
            $item['obs'] = $saida->obs;
            array_push($itens, $item);
        }
        return CashController::montaTabelaEntradaSaida($itens);
    }

    public static function buscaEntradasDebito($id){
//        CashMoves::getTIPOVENDA();
        $entradas = CashMoves::all()->where('cash_id','=', $id)->where('type','=', CashMoves::getTIPOVENDA())->where('debit','<>', null);
        $itens = array();
        foreach ($entradas as $entrada){
            $item['cliente'] =  Client::find(Order::find($entrada->order_id)->client_id)->name;
            $item['valor'] = $entrada->debit;
            $dataFormatada = new \DateTime($entrada->created_at);
            $item['datahora'] = $dataFormatada->format('d/m/Y H:i');
            array_push($itens, $item);
        }
        return CashController::montaTabelaPagamentos($itens);
    }

    public static function buscaEntradasCredito($id){
        $entradas = CashMoves::all()->where('cash_id','=', $id)->where('type','=', CashMoves::getTIPOVENDA())->where('credit','<>', null);
        $itens = array();
        foreach ($entradas as $entrada){
            $item['cliente'] =  Client::find(Order::find($entrada->order_id)->client_id)->name;
            $item['valor'] = $entrada->credit;
            $dataFormatada = new \DateTime($entrada->created_at);
            $item['datahora'] = $dataFormatada->format('d/m/Y H:i');
            array_push($itens, $item);
        }
        return CashController::montaTabelaPagamentos($itens);
    }

    public static function buscaEntradasDinheiro($id){
        $entradas = CashMoves::all()->where('cash_id','=', $id)->where('type','=', CashMoves::getTIPOVENDA())->where('money','<>', null);
        $itens = array();
        foreach ($entradas as $entrada){
            //exibe cliente ou exibe o número da mesa
            $item['cliente'] =  Client::find(Order::find($entrada->order_id)->client_id)->name;
            $item['valor'] = $entrada->money;
            $dataFormatada = new \DateTime($entrada->created_at);
            $item['datahora'] = $dataFormatada->format('d/m/Y H:i');
            array_push($itens, $item);
        }
        return CashController::montaTabelaPagamentos($itens);
    }

    private static function montaTabelaPagamentos($itens){
        $linhas = [];
        $header = '<table class="table table-condensed">
                                        <tr>
                                            <th style="text-align:center" width="50%">Cliente</th>
                                            <th style="text-align:center" width="25%">Data</th>
                                            <th style="text-align:center" width="25%">Valor</th>
                                        </tr>';
        foreach ($itens as $item){
            $linha = '<tr>
                                                <td style="text-align:left">'.$item['cliente'].'</td>
                                                <td style="text-align:center">'.$item['datahora'].'</td>
                                                <td style="text-align:center">'.$item['valor'].'</td>
                                          </tr>';
            array_push($linhas, $linha);
        }
        $footer = '</table>';
        $linhas = implode($linhas);

        return $header.$linhas.$footer;
    }

    private static function montaTabelaEntradaSaida($itens){
        $linhas = [];
        $header = '<table class="table table-condensed">
                                        <tr>
                                            <th style="text-align:center" width="20%">Usuário</th>
                                            <th style="text-align:center" width="20%">Data</th>
                                            <th style="text-align:center" width="20%">Valor</th>
                                            <th style="text-align:center" width="40%">Observação</th>
                                        </tr>';
        foreach ($itens as $item){
            $linha = '<tr>
                                                <td style="text-align:center">'.$item['usuario'].'</td>
                                                <td style="text-align:center">'.$item['datahora'].'</td>
                                                <td style="text-align:center">'.$item['valor'].'</td>
                                                <td style="text-align:center">'.$item['obs'].'</td>
                                          </tr>';
            array_push($linhas, $linha);
        }
        $footer = '</table>';
        $linhas = implode($linhas);

        return $header.$linhas.$footer;
    }
}

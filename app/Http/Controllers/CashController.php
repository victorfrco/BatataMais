<?php

namespace App\Http\Controllers;

use App\Models\Cash;
use App\Models\Category;
use function array_key_exists;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

	    $source = array('.', ',');
	    $replace = array('', '.');
	    $valor = str_replace($source, $replace, $valor);
	    $cash->inicial_value = $valor;
	    $cash->status = 1;
	    $cash->opened_at = new DateTime();
	    $cash->save();

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

	    $cash->closed_at = new DateTime();
	    $cash->status = 2;
	    $cash->final_value = $cash->inicial_value + $cash->atual_value;

	    if(array_key_exists('obs', $request->toArray()))
	    	$cash->obs = $request->get('obs');

	    $cash->update();

	    return Redirect::home();
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
}

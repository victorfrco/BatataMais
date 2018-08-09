<?php

namespace App\Http\Controllers;

use App\CashMoves;
use App\Models\Cash;
use Illuminate\Http\Request;

class CashMovesController extends Controller
{
    public static function buscaValoresDebito($id){
        $cashMoves = CashMoves::all()->where('cash_id','=', $id)->where('type','=',CashMoves::getTIPOVENDA())->sum('debit');
        return 'R$ '.number_format($cashMoves, 2,',', '.');
    }

    public static function buscaValoresCredito($id){
        $cashMoves = CashMoves::all()->where('cash_id','=', $id)->where('type','=',CashMoves::getTIPOVENDA())->sum('credit');
        return 'R$ '.number_format($cashMoves, 2,',', '.');
    }

    public static function buscaValoresDinheiro($id){
        $cashMoves = CashMoves::all()->where('cash_id','=', $id)->where('type','=',CashMoves::getTIPOVENDA())->sum('money');
        return 'R$ '.number_format($cashMoves, 2,',', '.');
    }

    public static function buscaValoresEntradas($id){
        $cashMoves = CashMoves::all()->where('cash_id','=', $id)->where('type','=',CashMoves::getTIPOENTRADA())->sum('total');
        return 'R$ '.number_format($cashMoves, 2,',', '.');
    }

    public static function buscaValoresSaidas($id){
        $cashMoves = CashMoves::all()->where('cash_id','=', $id)->whereIn('type',[CashMoves::getTIPOSAIDA(),CashMoves::getTIPODESCONTO()])->sum('total');
        return 'R$ '.number_format($cashMoves, 2,',', '.');
    }

    public static function buscaValorTotal($id){
        $debito = CashMoves::all()->where('cash_id','=', $id)->where('type','=',CashMoves::getTIPOVENDA())->sum('debit');
        $credito = CashMoves::all()->where('cash_id','=', $id)->where('type','=',CashMoves::getTIPOVENDA())->sum('credit');
        $dinheiro = CashMoves::all()->where('cash_id','=', $id)->where('type','=',CashMoves::getTIPOVENDA())->sum('money');
        $entradas = CashMoves::all()->where('cash_id','=', $id)->where('type','=',CashMoves::getTIPOENTRADA())->sum('total');
        $saidas = CashMoves::all()->where('cash_id','=', $id)->whereIn('type',[CashMoves::getTIPOSAIDA(),CashMoves::getTIPODESCONTO()])->sum('total');

        $total = $debito + $credito + $dinheiro + $entradas - $saidas;

        return 'R$ '.number_format($total, 2,',', '.');
    }

}


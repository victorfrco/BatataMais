<?php

namespace App\Dao;
use Illuminate\Support\Facades\DB;

/**
 * Class DaoOrder
 * @package App\Dao
 */
class DaoOrder
{
    /**
     * @param $dataInicial
     * @param null $dataFinal
     * @param null $status
     *
     * @return \Illuminate\Support\Collection
     */
    public function buscaTotalDeVendas($dataInicial, $dataFinal = null, $status = null){
        if(isset($dataFinal)){
            if($status == 0)
                return DB::table('orders')->whereNull('original_order')->whereBetween('created_at', [$dataInicial, $dataFinal])->get();
            else
                return DB::table('orders')->whereNull('original_order')->whereBetween('created_at', [$dataInicial, $dataFinal])->where('status', '=', $status)->get();
        }
    }

    /**
     * @param $dataInicial
     * @param $formaDePagamento
     * @param null $dataFinal
     *
     * @return \Illuminate\Support\Collection
     */
    public function buscaVendasPorFormaDePagamento($dataInicial, $formaDePagamento, $dataFinal = null){
        if(isset($dataFinal)){
            return DB::table('orders')->whereNull('original_order')->whereBetween('created_at', [$dataInicial, $dataFinal])->where('pay_method', '=', $formaDePagamento)->get();
        }
    }

    /**
     * @param $dataInicial
     * @param $formaDePagamento
     * @param null $dataFinal
     *
     * @return \Illuminate\Support\Collection
     */
    public function buscaVendasPorFormaDePagamentoCaixa($dataInicial, $formaDePagamento, $dataFinal = null){
        if(isset($dataFinal)){
            return DB::table('orders')->whereBetween('created_at', [$dataInicial, $dataFinal])->where('pay_method', '=', $formaDePagamento)->get();
        }
    }

    /**
     * @param $dataInicial
     * @param $idVendedor
     * @param null $dataFinal
     *
     * @return \Illuminate\Support\Collection
     */
    public function buscaVendasPorVendedor($dataInicial, $idVendedor, $dataFinal = null){
        if(isset($dataFinal)){
            return DB::table('orders')->whereNull('original_order')->whereBetween('created_at', [$dataInicial, $dataFinal])->where('user_id', '=', $idVendedor)->get();
        }
    }

}
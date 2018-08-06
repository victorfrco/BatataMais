<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CashMoves extends Model
{
    //
    private static $TIPO_ENTRADA = 1;
    private static $TIPO_SAIDA = 2;
    private static $TIPO_VENDA = 3;
    private static $TIPO_DESCONTO = 4;
    private static $TIPO_BONIFICACAO = 5;


    protected $table = 'cash_moves';
    protected $fillable = ['total', 'debit', 'credit', 'money', 'obs', 'type', 'cash_id', 'order_id', 'user_id'];

    /**
     * @return int
     */
    public static function getTIPODESCONTO()
    {
        return self::$TIPO_DESCONTO;
    }

    /**
     * @return int
     */
    public static function getTIPOBONIFICACAO()
    {
        return self::$TIPO_BONIFICACAO;
    }

    /**
     * @return int
     */
    public static function getTIPOENTRADA()
    {
        return self::$TIPO_ENTRADA;
    }

    /**
     * @return int
     */
    public static function getTIPOSAIDA()
    {
        return self::$TIPO_SAIDA;
    }

    /**
     * @return int
     */
    public static function getTIPOVENDA()
    {
        return self::$TIPO_VENDA;
    }



}

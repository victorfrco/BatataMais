<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CashMoves extends Model
{
    //
    private static $TIPO_ENTRADA = 1;
    private static $TIPO_SAIDA = 2;
    private static $TIPO_VENDA = 3;

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

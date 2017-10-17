<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';
    protected $fillable = ['total', 'status'];

    public function itens()
    {
        return $this->hasMany(Item::class);
    }
}

<?php

namespace App\Models;

use App\Models\Client;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';
    protected $fillable = ['total', 'status', 'client_id', 'user_id', 'associated'];

    public function itens()
    {
        return $this->hasMany(Item::class);
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}

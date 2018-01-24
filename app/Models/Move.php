<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Move extends Model
{
	protected $table = 'moves';
	protected $fillable = ['status', 'client_id', 'user_id', 'product_id', 'qtd', 'vlrUnit'];
}

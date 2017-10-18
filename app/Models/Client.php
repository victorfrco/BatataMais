<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $table = 'clients';
    protected $fillable = ['name', 'cpf', 'tel', 'tel2', 'email', 'obs', 'associado', 'endereco', 'nickname'];

/*
    public function orders()
    {
        return $this->hasMany(Order::class);
    }
*/
}

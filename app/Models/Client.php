<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $table = 'clients';
    protected $fillable = ['name', 'nickname', 'phone1', 'phone2'
        , 'email', 'cpf', 'associated', 'associated_id', 'obs'
        , 'adr_street', 'adr_number', 'adr_neighborhood', 'adr_cep', 'adr_compl'];

/*
    public function orders()
    {
        return $this->hasMany(Order::class);
    }
*/
}

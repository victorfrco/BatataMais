<?php

namespace App\Models;

use App\Order;
use Bootstrapper\Interfaces\TableInterface;
use Illuminate\Database\Eloquent\Model;

class Client extends Model implements TableInterface
{
    protected $table = 'clients';
    protected $fillable = ['name', 'nickname', 'phone1'
        , 'email', 'cpf', 'obs', 'adr_street', 'adr_number'
        , 'adr_neighborhood', 'adr_cep', 'adr_compl'];


    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    /**
     * A list of headers to be used when a table is displayed
     *
     * @return array
     */
    public function getTableHeaders()
    {
        return ['Id', 'Nome', 'Apelido', 'Telefone', 'Email', 'CPF'];
    }

    /**
     * Get the value for a given header. Note that this will be the value
     * passed to any callback functions that are being used.
     *
     * @param string $header
     * @return mixed
     */
    public function getValueForHeader($header)
    {
        switch ($header){
            case 'Id':
                return $this->id;
                break;
            case 'Nome':
                return $this->name;
                break;
            case 'Apelido':
                return $this->nickname;
                break;
            case 'Telefone':
                return $this->phone1;
                break;
            case 'Email':
                return $this->email;
                break;
            case 'CPF':
                return $this->cpf;
                break;
        }
    }
}

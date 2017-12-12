<?php

namespace App\Models;

use Bootstrapper\Interfaces\TableInterface;
use Illuminate\Database\Eloquent\Model;

class Provider extends Model implements TableInterface
{
    protected $table = 'providers';
    protected $fillable = ['name', 'description', 'agent', 'phone1', 'phone2', 'email'];

    /**
     * A list of headers to be used when a table is displayed
     *
     * @return array
     */
    public function getTableHeaders()
    {
        return ['Empresa', 'Representante', 'Telefone 1', 'Telefone 2', 'Email', 'Descrição'];
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
            case 'Empresa':
                return $this->name;
                break;
            case 'Representante':
                return $this->agent;
                break;
            case 'Telefone 1':
                return $this->phone1;
                break;
            case 'Telefone 2':
                return $this->phone2;
                break;
            case 'Email':
                return $this->email;
                break;
            case 'Descrição':
                return $this->description;
                break;
        }

    }
}



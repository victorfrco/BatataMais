<?php

namespace App\Models;

use Bootstrapper\Interfaces\TableInterface;
use Illuminate\Database\Eloquent\Model;

class Product extends Model implements TableInterface
{
    protected $table = 'products';
    protected $fillable = ['name', 'description', 'price_cost', 'price_resale', 'price_discount', 'barcode', 'qtd', 'brand_id'];

    public function brands(){
        return $this->belongsTo(Brand::class);
    }

    public function itens()
    {
        return $this->belongsToMany(Item::class);
    }

    /**
     * A list of headers to be used when a table is displayed
     *
     * @return array
     */
    public function getTableHeaders()
    {
        return ['Id', 'Nome', 'Descrição', 'Preço de Custo', 'Preço de Venda', 'Preço Associado', 'Estoque', 'Código de Barras'];
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
            case 'Descrição':
                return $this->description;
                break;
            case 'Preço de Custo':
                return 'R$ '.number_format((float)$this->price_cost, 2, '.', '');
                break;
            case 'Preço de Venda':
	            return 'R$ '.number_format((float)$this->price_resale, 2, '.', '');
                break;
            case 'Preço Associado':
	            return 'R$ '.number_format((float)$this->price_discount, 2, '.', '');
                break;
	        case 'Estoque':
		        return $this->qtd;
		        break;
	        case 'Código de Barras':
		        return $this->barcode;
		        break;
        }
    }
}

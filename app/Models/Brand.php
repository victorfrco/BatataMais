<?php

namespace App\Models;

use Bootstrapper\Facades\Image;
use Bootstrapper\Interfaces\TableInterface;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model implements TableInterface
{
    protected $table = 'brands';
    protected $fillable = ['name', 'description', 'logo_path', 'status', 'category_id'];

    public static function criaLista($id)
    {

      $divCab =  '<div class="col-sm-3" style="height: 170px; font-size: 12px; font-weight:bold; text-align: center;">';
      $brand = Brand::find($id);

      $divCont = $brand->name.Image::rounded($brand->logo_path, 'rounded')
                                    ->responsive()
                                    ->withAttributes(['style' => 'max-height:140px; padding-left:7px']);

      $divEnd = ' </div>';
      $divpronta = $divCab.$divCont.$divEnd;
      return $divpronta;
    }

    public function products()
    {
        return $this->belongsToMany(Product::class);
    }

    /**
     * A list of headers to be used when a table is displayed
     *
     * @return array
     */
    public function getTableHeaders()
    {
        return ['Id', 'Nome', 'Descrição', 'Logo'];
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
            case 'Logo':
                return $this->logo_id;
                break;
        }
    }
}

<?php

namespace App\Models;

use Bootstrapper\Facades\Image;
use Bootstrapper\Interfaces\TableInterface;
use Illuminate\Database\Eloquent\Model;
use function substr;

class Brand extends Model implements TableInterface
{
    protected $table = 'brands';
    protected $fillable = ['name', 'description', 'logo_path', 'status', 'category_id'];

    public static function criaLista($id)
    {

      $divCab =  '<div value="'.$id.'" data-id="'.$id.'" data-target="#productModal" data-toggle="modal" class="col-sm-2 product-modal" style="width: 145px; height: 145px; font-size: 12px; font-weight:bold; text-align: center;">';
      $brand = Brand::find($id);
      if($brand->logo_path != null)
        $divCont = substr($brand->name,0, 15).Image::circle(asset($brand->logo_path), 'rounded')
                                    ->responsive()
                                    ->withAttributes(['style' => 'background-color: #ffffff;height:110px;']);
      else
        $divCont = substr($brand->name,0, 15).Image::circle(asset('storage/images/brands/nobrand.gif'), 'rounded')
                       ->responsive()
                       ->withAttributes(['style' => 'height:110px']);

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

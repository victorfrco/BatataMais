<?php
/**
 * Created by PhpStorm.
 * User: victor.oliveira
 * Date: 16/01/2018
 * Time: 20:24
 */

namespace App\Models;


use App\User;
use Bootstrapper\Interfaces\TableInterface;
use Illuminate\Database\Eloquent\Model;

class Bonification extends Model implements TableInterface {

	protected $table = 'bonifications';
	protected $fillable = ['order_id', 'client_id', 'item_id', 'user_id'];

	/**
	 * A list of headers to be used when a table is displayed
	 *
	 * @return array
	 */
	public function getTableHeaders() {
		return ['Id', 'Vendedor', 'Cliente', 'Item', 'Qtd.', 'Valor Total', 'Data'];
	}

	/**
	 * Get the value for a given header. Note that this will be the value
	 * passed to any callback functions that are being used.
	 *
	 * @param string $header
	 *
	 * @return mixed
	 */
	public function getValueForHeader( $header ) {
		switch ($header){
			case 'Id':
				return $this->id;
				break;
			case 'Vendedor':
				return User::find($this->user_id)->name;
				break;
			case 'Cliente':
				return Client::find($this->client_id)->nickname;
				break;
			case 'Item':
				$item = Item::find($this->item_id);
				$product = Product::find($item->product_id);
				return $product->name;
				break;
			case 'Qtd.':
				$item = Item::find($this->item_id);
				return $item->qtd;
				break;
			case 'Valor Total':
				$item = Item::find($this->item_id);
				return 'R$ '.number_format($item->total, 2, ',', '.');
				break;
			case 'Id. Venda':
				return $this->order_id;
				break;
			case 'Data':
				$dataFormatada = new \DateTime($this->created_at);
				return $dataFormatada->format('d/m/Y H:i');
				break;
		}
}}
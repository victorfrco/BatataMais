<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cash extends Model
{
	protected $table = 'cashes';
	protected $fillable = ['user_id', 'status', 'inicial_value', 'atual_value', 'final_value', 'opened_at', 'closed_at', 'obs'];

	public function getDataAberturaFormatada(){
		$dataFormatada = new \DateTime($this->opened_at);
		return $dataFormatada->format('d/m/Y H:i');
	}

	public function getValorAtualFormatado(){
		return 'R$'.number_format($this->atual_value, 2, ',', '.');
	}

	public function getValorAberturaFormatado(){
		return 'R$'.number_format($this->inicial_value, 2, ',', '.');
	}

	public function getValorTotalFormatado(){
		$total = $this->inicial_value + $this->atual_value;
		return 'R$'.number_format($total, 2, ',', '.');
	}
}

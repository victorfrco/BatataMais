<?php

namespace App\Forms;

use App\Models\Brand;
use App\Models\Category;
use Kris\LaravelFormBuilder\Form;

class ProductForm extends Form
{
    public function buildForm()
    {
        $this
            ->add('name', 'text', ['label' => 'Nome', 'rules' => 'required'])
            ->add('description', 'text', ['label' => 'Descrição'])
            ->add('price_cost', 'text', ['label' => 'Preço de Compra', 'rules' => 'required'])
            ->add('price_resale', 'text', ['label' => 'Preço de Venda', 'rules' => 'required'])
            ->add('price_discount', 'text', ['label' => 'Preço Associado', 'rules' => 'required'])
            ->add('price_card', 'text', ['label' => 'Preço Cartão', 'rules' => 'required'])
	        ->add('barcode','text', ['label' => 'Código de Barras'])
            ->add('brand_id','entity', [
                'label' => 'Marca',
                'class' => 'App\Models\Brand',
                'property' => 'name',
                'property_key' => 'id',
                'query_builder' => function (Brand $brand) {
                    // If query builder option is not provided, all data is fetched
                    return $brand;
                }
            ]);
    }
}

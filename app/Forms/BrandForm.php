<?php

namespace App\Forms;

use App\Models\Category;
use Kris\LaravelFormBuilder\Form;

class BrandForm extends Form
{
    public function buildForm()
    {
        $this
            ->add('name', 'text',[
                'label' => 'Nome'
            ])
            ->add('description', 'text', [
                'label' => 'Descrição'
            ])->add('category_id','entity', [
                'label' => 'Categoria',
                'class' => 'App\Models\Category',
                'property' => 'name',
                'property_key' => 'id',
                'query_builder' => function (Category $category) {
                    // If query builder option is not provided, all data is fetched
                    return $category;
                }
            ])->add('logo','file', [
		        'label' => 'Logo'
	        ])->add('status','checkbox',['label' => 'Ativo']);
    }
}
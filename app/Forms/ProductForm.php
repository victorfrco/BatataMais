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
            ->add('name', 'text')
            ->add('description', 'text')
            ->add('price_cost', 'text')
            ->add('price_resale', 'text')
            ->add('price_discount', 'text')
            ->add('category_id','entity', [
                'class' => 'App\Models\Category',
                'property' => 'name',
                'property_key' => 'id',
                'query_builder' => function (Category $category) {
                    // If query builder option is not provided, all data is fetched
                    return $category;
                }
            ])
            ->add('brand_id','entity', [
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

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
            ])->add('logo_id', 'text');
    }
}

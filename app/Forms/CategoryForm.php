<?php

namespace App\Forms;

use Kris\LaravelFormBuilder\Form;

class CategoryForm extends Form
{
    public function buildForm()
    {
        $this
            ->add('name', 'text', [
                'label' => 'Nome',
                'rules' => 'required|max:255'
            ])
            ->add('description', 'text', ['label' => 'Descrição'])
            ->add('status','checkbox',['label' => 'Ativo']);
    }
}

<?php

namespace App\Forms;

use Kris\LaravelFormBuilder\Form;

class ClientForm extends Form
{
    public function buildForm()
    {
//        $id = $this->getData('id');
        $this
            ->add('name', 'text')
            ->add('phone1', 'text')
            ->add('associated', 'checkbox')
//            ->add('cpf', 'text', [
//                'rules' => "max:11|unique:clients,cpf,{$id}"
//            ])
            ;
    }
}

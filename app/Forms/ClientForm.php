<?php

namespace App\Forms;

use Kris\LaravelFormBuilder\Form;

class ClientForm extends Form
{
    public function buildForm()
    {
        $id = $this->getData('id');
        $this
            ->add('name', 'text',[
                'label' => 'Nome'
            ])
            ->add('nickname', 'text', [
                'label' => 'Apelido',
                'rules' => 'required'
            ])
            ->add('phone1', 'text', [
                'label' => 'Telefone',
                'rules' => 'max:11|required'
            ])
//            ->add('cpf', 'text', [
//                'label' => 'CPF',
//                'rules' => "max:11|unique:clients,cpf,{$id}"
//            ])
        ;
    }
}

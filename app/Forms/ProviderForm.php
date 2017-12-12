<?php

namespace App\Forms;

use Kris\LaravelFormBuilder\Form;

class ProviderForm extends Form
{
    public function buildForm()
    {
        $this
            ->add('name', 'text', ['label' => 'Empresa', 'rules' => 'required'])
            ->add('agent', 'text', ['label' => 'Representante'])
            ->add('phone1', 'text', ['label' => 'Telefone 1', 'rules' => 'required|max:11'])
            ->add('phone2', 'text', ['label' => 'Telefone 2',  'rules' => 'max:11'])
            ->add('email', 'email', ['label' => 'Email']);
    }
}

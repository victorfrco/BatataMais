<?php

namespace App\Forms;

use Kris\LaravelFormBuilder\Form;

class ClientForm extends Form
{
    public function buildForm()
    {
        $this
            ->add('name', 'text',[
                'label' => 'Nome',
                'rules' => 'required'
            ])
            ->add('nickname', 'text', [
                'label' => 'Razão Social',
                'rules' => 'required'
            ])
	        ->add('phone1', 'text', [
		        'label' => 'Tel. Celular',
		        'rules' => 'max:11|required'])
        ;
    }
}

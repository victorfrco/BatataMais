<?php

namespace App\Forms;

use Kris\LaravelFormBuilder\Form;

class ClientForm extends Form
{
    public function buildForm()
    {
        $this
            ->add('name', 'text')
            ->add('phone1', 'text')
            ->add('associated', 'checkbox');
    }
}

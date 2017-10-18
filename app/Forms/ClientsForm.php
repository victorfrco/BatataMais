<?php

namespace App\Forms;

use Kris\LaravelFormBuilder\Form;

class ClientsForm extends Form
{
    public function buildForm()
    {
        $this
            ->add('name', 'text');
    }
}

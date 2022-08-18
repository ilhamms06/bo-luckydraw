<?php

namespace App\Forms;

use Kris\LaravelFormBuilder\Form;

class ProjectForm extends Form
{
    public function buildForm()
    {
        $this
            // ->add('user_id', 'select')
            ->add('name', 'text')
            ->add('background', 'text',['template' => 'templates.dropify', 'label' => 'Background'])
            // ->add('unique_field', 'text')
            ->add('submit', 'submit', ['label'=>'Save', 'attr'=>['class'=>'btn btn-primary']]);
    }
}

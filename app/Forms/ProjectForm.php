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
            ->add('background', 'text',['template' => 'templates.dropify', 'label' => 'Background', 'attr' => ['data-allowed-file-extensions' => 'jpg jpeg png', 'data-min-width' => 999, 'data-max-width' => 1001, 'data-min-height' => 699, 'data-max-height' => 701]])
            ->add('unique_field', 'text')
            ->add('submit', 'submit', ['label'=>'Save', 'attr'=>['class'=>'btn btn-primary']]);
    }
}

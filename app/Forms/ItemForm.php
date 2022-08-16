<?php

namespace App\Forms;

use Kris\LaravelFormBuilder\Form;

class ItemForm extends Form
{
    public function buildForm()
    {
        $this
            // ->add('screen_id', 'select')
            ->add('screen_id', 'entity',[
                'empty_value' => 'Pilih Screen',
                'class' => 'App\Models\Screen',
                'property' => 'name',
                'label' => 'Screen',
                'attr' => ['class' => 'form-control ']
            ])
            ->add('name', 'text')
            ->add('image', 'text')
            ->add('total_draw', 'text')
            ->add('limit_per_draw', 'text')
            ->add('submit', 'submit', ['label'=>'Save', 'attr'=>['class'=>'btn btn-primary']]);
    }
}

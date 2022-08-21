<?php

namespace App\Forms;

use Kris\LaravelFormBuilder\Form;

class ParticipantForm extends Form
{
    public function buildForm()
    {
        $this
            ->add('project_id', 'entity',[
                'empty_value' => 'Pilih Project',
                'class' => 'App\Models\Project',
                'property' => 'name',
                'label' => 'Project',
                'attr' => ['class' => 'form-control ']
            ])
            ->add('screen_id', 'entity',[
                'empty_value' => 'Pilih Screen',
                'class' => 'App\Models\Screen',
                'property' => 'name',
                'label' => 'Screen',
                'attr' => ['class' => 'form-control ']
            ])
            ->add('item_id', 'entity',[
                'empty_value' => 'Pilih Item',
                'class' => 'App\Models\Item',
                'property' => 'name',
                'label' => 'Item',
                'attr' => ['class' => 'form-control ']
            ])            
            // ->add('code', 'text')
            ->add('name', 'text')
            ->add('email', 'text')
            ->add('phone', 'text')
            ->add('branch', 'text')
            ->add('province', 'text')
            ->add('city', 'text')
            ->add('submit', 'submit', ['label'=>'Save', 'attr'=>['class'=>'btn btn-primary']]);
    }
}

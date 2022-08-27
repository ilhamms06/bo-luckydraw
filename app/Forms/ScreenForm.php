<?php

namespace App\Forms;

use App\Models\Project;
use Illuminate\Support\Facades\Auth;
use Kris\LaravelFormBuilder\Form;

class ScreenForm extends Form
{
    public function buildForm()
    {
        $this
            // ->add('project_id', 'select')
            ->add('project_id', 'entity',[
                'empty_value' => 'Pilih Project',
                'class' => 'App\Models\Project',
                'property' => 'name',
                'query_builder' => function (Project $lang) {
                    return $lang->where('user_id', Auth::user()->id);
                },
                'label' => 'Project',
                'attr' => ['class' => 'form-control ']
            ])
            ->add('name', 'text')
            ->add('submit', 'submit', ['label'=>'Save', 'attr'=>['class'=>'btn btn-primary']]);
    }
}

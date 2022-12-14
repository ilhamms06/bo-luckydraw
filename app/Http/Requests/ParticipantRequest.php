<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ParticipantRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'project_id' => 'required',
            'screen_id' => 'required',
            'item_id' => 'required',
            'name' => 'required',
            'email' => 'required|unique:participants,email',
            'phone' => 'required',
            'branch' => 'required',
            'province' => 'required',
            'city' => 'required',
        ];
    }
}

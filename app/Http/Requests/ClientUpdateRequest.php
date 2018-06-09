<?php

namespace App\Http\Requests;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class ClientUpdateRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $id = $this->route('client-edit');
        return [
            'name' => 'required|max:100|unique:clients,name,'.$id,
            'email' => 'email|nullable',
            'tel' => 'numeric|nullable'
        ];
    }

}

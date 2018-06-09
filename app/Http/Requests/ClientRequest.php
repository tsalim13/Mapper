<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClientRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|max:100|unique:clients,name',
            'email' => 'email|max:60|nullable',
            'tel' => 'numeric|nullable'
        ];
    }

    public function messages()
    {
        return [
            'name.unique' => 'Le client existe deja',
        ];
    }
}

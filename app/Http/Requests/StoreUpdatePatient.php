<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUpdatePatient extends FormRequest
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
        $uuid = $this->patient ?? '';

        $rules = [
            'user' => ['required', 'exists:users,uuid'],
            'name' => ['required', 'string', 'min:3', 'max:100'],
            'phone' => ['required', 'string', 'digits:11'],
            'email' => ['required', 'email', 'max:255', "unique:users,email,{$uuid},uuid"],
            'dob' => ['required', 'date'],
            'gender' => ['required', 'in:Masculino,Feminino,Outros'],
            'height' => ['required', 'regex:/^\d+(\.\d{1,2})?$/'],
            'weight' => ['required', 'regex:/^\d+(\.\d{1,2})?$/'],
        ];

        if ($this->method() == 'PUT') {
            $rules = [
            'user' => ['required', 'exists:users,uuid'],
            'name' => ['nullable', 'string', 'min:3', 'max:100'],
            'phone' => ['nullable', 'string', 'digits:11'],
            'email' => ['nullable', 'email', 'max:255', "unique:users,email,{$uuid},uuid"],
            'dob' => ['nullable', 'date'],
            'gender' => ['nullable', 'in:Masculino,Feminino,Outros'],
            'height' => ['nullable', 'regex:/^\d+(\.\d{1,2})?$/'],
            'weight' => ['nullable', 'regex:/^\d+(\.\d{1,2})?$/'],
            ];
        }

        return $rules;
    }
}

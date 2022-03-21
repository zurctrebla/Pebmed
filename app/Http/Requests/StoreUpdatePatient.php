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
            'name' => ['required', 'string', 'min:3', 'max:100'],
            'phone' => ['required', 'string', 'min:11', 'max:11'],
            'email' => ['required', 'email', 'max:255', "unique:users,email,{$uuid},uuid"],

            'dob' => ['required', 'date'],
            'gender' => ['required', 'string'],
            'height' => ['required',],
            'weight' => ['required',],
        ];

        if ($this->method() == 'PUT') {
            $rules['password'] = ['nullable', 'min:4', 'max:16'];
        }

        return $rules;
    }
}

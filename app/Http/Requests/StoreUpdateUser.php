<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUpdateUser extends FormRequest
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
        $uuid = $this->user ?? '';

        $rules = [
            'name' => ['required', 'string', 'min:3', 'max:100'],
            'email' => ['required', 'email', 'max:255', "unique:users,email,{$uuid},uuid"],
            'password' => ['required', 'min:8', 'max:16'],
        ];

        if ($this->method() == 'PUT') {
            $rules['password'] = ['nullable', 'min:4', 'max:16'];
            $rules['email'] = ['nullable', 'email', 'max:255'];
        }

        return $rules;
    }
}

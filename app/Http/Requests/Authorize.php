<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Authorize extends FormRequest
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
            'email' => 'required|exists:admins,admin_email'
        ];
    }
    public function messages()
    {
        return [
            'email.required' => 'Введите email',
            'email.exists' => 'Такого email нет в базе',
            'password.required' => 'Введите пароль'
        ];
    }
}

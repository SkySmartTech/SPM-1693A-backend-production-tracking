<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class UserRegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'epf'           => 'required|string|max:10|unique:users,epf',
            'employeeName'  => 'required|string|max:255',
            'username'      => 'required|string|max:255|unique:users,username',
            'password'      => 'required|string|min:8|confirmed',
            'department'    => 'required|string|max:255',
            'contact'       => 'required|string|max:15',
            'email'         => 'required|string|email|max:255',
        ];
    }
}

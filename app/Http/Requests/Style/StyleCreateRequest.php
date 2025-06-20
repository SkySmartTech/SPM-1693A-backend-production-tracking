<?php

namespace App\Http\Requests\Style;

use Illuminate\Foundation\Http\FormRequest;

class StyleCreateRequest extends FormRequest
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
            'styleNo'          => 'required|integer|unique:style_settings,styleNo',
            'styleDescription' => 'required|string',
            'state'             => 'required|integer',
            'status'            => 'required|integer',
        ];
    }
}

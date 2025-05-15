<?php

namespace App\Http\Requests\Color;

use Illuminate\Foundation\Http\FormRequest;

class ColorUpdateRequest extends FormRequest
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
            'color'         => 'sometimes|string|max:255|unique:color_settings,color',
            'color_code'    => 'sometimes|string|max:7|regex:/^#[0-9A-Fa-f]{6}$/|unique:color_settings,color_code',
        ];
    }
}

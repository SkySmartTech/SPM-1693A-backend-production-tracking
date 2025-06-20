<?php

namespace App\Http\Requests\Defect;

use Illuminate\Foundation\Http\FormRequest;

class DefectUpdateRequest extends FormRequest
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
            'styleNo'      => 'required|integer|exists:style_settings,styleNo',
            'operation'     => 'required|integer|exists:operations,operation',
            'codeNo'       => 'required|integer',
            'defectCode'   => 'required|string',
            'status'        => 'required|string',
        ];
    }
}

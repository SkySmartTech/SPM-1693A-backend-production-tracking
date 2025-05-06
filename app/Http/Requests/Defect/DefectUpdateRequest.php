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
            //'style_no'     => 'required|string|exists:style_settings,style_no',
            //'operation'    => 'required|integer|exists:operations,operation',
            'code_no'       => 'required|integer',
            'defect_code'   => 'required|string|unique:defects,defect_code',
            'status'        => 'required|string',
        ];
    }
}

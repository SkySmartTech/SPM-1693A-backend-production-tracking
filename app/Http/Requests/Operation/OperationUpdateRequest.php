<?php

namespace App\Http\Requests\Operation;

use Illuminate\Foundation\Http\FormRequest;

class OperationUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'styleNo'     => 'required|integer|exists:style_settings,styleNo',
            'operation'   => 'required|integer',
            'sequenceNo'  => 'required|string',
            'smv'         => 'required|numeric',
            'status'      => 'required|string',
        ];
    }
}

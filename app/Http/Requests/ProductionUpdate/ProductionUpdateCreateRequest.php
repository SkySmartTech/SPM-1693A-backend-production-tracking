<?php

namespace App\Http\Requests\ProductionUpdate;

use Illuminate\Foundation\Http\FormRequest;

class ProductionUpdateCreateRequest extends FormRequest
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
            'lineNo'            => 'required|string|max:255',
            'QRCode'            => 'nullable|string|max:255|unique:production_updates,QRCode',
            'buyer'             => 'nullable|string|max:255',
            'gg'                => 'nullable|string|max:255',
            'smv'               => 'nullable|numeric',
            'presentCarder'     => 'nullable|numeric',
            'style'             => 'required|string|max:255',
            'color'             => 'required|string|max:255',
            'sizeName'          => 'required|string|max:255',
            'checkPoint'        => 'required|string|max:255',
            'qualityState'      => 'nullable|string|max:255',
            'part'              => 'nullable|string|max:255',
            'location'          => 'nullable|string|max:255',
            'defectCode'        => 'nullable|string|max:255',
            'state'             => 'nullable|integer',
        ];
    }
}

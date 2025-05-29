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
            'server_date_time' => 'required|date',
            'line_no'          => 'nullable|string|max:255',
            'qr_code'          => 'nullable|string|max:255|unique:production_updates,qr_code',
            'buyer'            => 'nullable|string|max:255',
            'gg'               => 'nullable|string|max:255',
            'smv'              => 'nullable|numeric',
            'present_carder'   => 'nullable|numeric',
            'style'            => 'nullable|string|max:255',
            'color'            => 'nullable|string|max:255',
            'size_name'        => 'nullable|string|max:255',
            'check_point'      => 'nullable|string|max:255',
            'quality_state'    => 'nullable|string|max:255',
            'part'             => 'nullable|string|max:255',
            'location'         => 'nullable|string|max:255',
            'defect_code'      => 'nullable|string|max:255',
            'state'            => 'nullable|integer',
        ];
    }
}

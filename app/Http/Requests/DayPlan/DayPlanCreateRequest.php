<?php

namespace App\Http\Requests\DayPlan;

use Illuminate\Foundation\Http\FormRequest;

class DayPlanCreateRequest extends FormRequest
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
            'line_no'           => 'required|string|max:255|unique:day_plans,line_no',
            'resp_employee'     => 'required|string|max:255',
            'buyer'             => 'required|string|max:255',
            'style'             => 'required|string|max:255',
            'gg'                => 'required|string|max:255',
            'smv'               => 'required|numeric',
            'display_wh'        => 'required|integer',
            'actual_wh'         => 'required|string|max:255',
            'plan_tgt_pcs'      => 'required|numeric',
            'per_hour_pcs'      => 'required|numeric',
            'available_cader'   => 'required|integer',
            'present_linkers'   => 'required|integer',
            'status'            => 'required|integer'
        ];
    }
}

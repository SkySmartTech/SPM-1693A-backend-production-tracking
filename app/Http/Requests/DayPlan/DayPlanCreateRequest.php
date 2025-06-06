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
        'day_plans'                     => 'required|array',
        'day_plans.*.line_no'           => 'required|string|max:255|unique:day_plans,line_no',
        'day_plans.*.resp_employee'     => 'required|string|max:255',
        'day_plans.*.buyer'             => 'required|string|max:255',
        'day_plans.*.style'             => 'required|string|max:255',
        'day_plans.*.gg'                => 'required|string|max:255',
        'day_plans.*.smv'               => 'required|numeric',
        'day_plans.*.display_wh'        => 'required|integer',
        'day_plans.*.actual_wh'         => 'required|string|max:255',
        'day_plans.*.plan_tgt_pcs'      => 'required|numeric',
        'day_plans.*.per_hour_pcs'      => 'required|numeric',
        'day_plans.*.available_cader'   => 'required|integer',
        'day_plans.*.present_linkers'   => 'required|integer',
        'day_plans.*.CheckPointName'    => 'required|string|max:255',
        'day_plans.*.status'            => 'required|integer'
        ];
    }
}

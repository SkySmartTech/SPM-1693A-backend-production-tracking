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
        'day_plans.*.lineNo'           => 'required|string|max:255|unique:day_plans,line_no',
        'day_plans.*.respEmployee'     => 'required|string|max:255',
        'day_plans.*.buyer'             => 'required|string|max:255',
        'day_plans.*.style'             => 'required|string|max:255',
        'day_plans.*.gg'                => 'required|string|max:255',
        'day_plans.*.smv'               => 'required|numeric',
        'day_plans.*.displayWH'        => 'required|integer',
        'day_plans.*.actualWH'         => 'required|string|max:255',
        'day_plans.*.planTgtPcs'      => 'required|numeric',
        'day_plans.*.perHourPcs'      => 'required|numeric',
        'day_plans.*.availableCader'   => 'required|integer',
        'day_plans.*.presentLinkers'   => 'required|integer',
        'day_plans.*.CheckPointName'    => 'required|string|max:255',
        'day_plans.*.status'            => 'required|integer'
        ];
    }
}

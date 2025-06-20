<?php
namespace App\Http\Requests\Size;

use Illuminate\Foundation\Http\FormRequest;

class SizeCreateRequest extends FormRequest
{

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
            'sizeName'   => 'required|string|max:255',
            'description' => 'required|string',
        ];
    }
}

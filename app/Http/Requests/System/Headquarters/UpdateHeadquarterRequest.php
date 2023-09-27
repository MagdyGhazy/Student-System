<?php

namespace App\Http\Requests\System\Headquarters;

use Illuminate\Foundation\Http\FormRequest;

class UpdateHeadquarterRequest extends FormRequest
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
            'id' => 'required|exists:headquarters,id',
            'name' => 'required|string|min:2',
            'address' => 'required|string|min:2',
        ];
    }
}

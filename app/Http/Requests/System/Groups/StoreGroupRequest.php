<?php

namespace App\Http\Requests\System\Groups;

use Illuminate\Foundation\Http\FormRequest;

class StoreGroupRequest extends FormRequest
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
            'headquarter_id' => 'required|exists:headquarters,id',
            'grade_id' => 'required|exists:grades,id',
            'days' => 'required',
            'start_at' => 'required',
        ];
    }
}

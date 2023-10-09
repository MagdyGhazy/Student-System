<?php

namespace App\Http\Requests\System\Quizzes;

use Illuminate\Foundation\Http\FormRequest;

class UpdateQuizRequest extends FormRequest
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

            'id' => 'required|exists:quizzes,id',
            'name' => 'required|string|min:2',
            'day' => 'required',
            'grade_id' => 'required|exists:grades,id',
        ];
    }
}

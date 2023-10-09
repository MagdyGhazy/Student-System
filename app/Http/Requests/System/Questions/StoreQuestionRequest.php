<?php

namespace App\Http\Requests\System\Questions;

use Illuminate\Foundation\Http\FormRequest;

class StoreQuestionRequest extends FormRequest
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
            'title' => 'required|string|min:2',
            'answers' => 'required|array',
            'correct_answer' => 'required|string|min:2',
            'points' => 'required|integer',
            'quiz_id' => 'required|exists:quizzes,id',
        ];
    }
}

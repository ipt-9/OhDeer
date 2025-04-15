<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePostRequest extends FormRequest
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
            'title' => 'sometimes|string|min:3|max:128',
            'description' => 'sometimes|string',
            'price' => 'sometimes|numeric|min:0',
            'is_repair' => 'sometimes|boolean',
            'category_id' => 'sometimes|integer|min:1',
        ];
    }

    public function messages(): array
    {
        return [
            'title.string' => 'The title must be a string.',
            'title.min' => 'The title must be at least 3 characters.',
            'title.max' => 'The title cannot be longer than 128 characters.',

            'description.string' => 'The description must be a string.',

            'price.numeric' => 'The price must be a number.',
            'price.min' => 'The price must be a positive value.',

            'is_repair.boolean' => 'The repair status must be true or false.',
            'is_complete.boolean' => 'The completion status must be true or false.',

            'category_id.integer' => 'The category ID must be an integer.',
            'category_id.min' => 'The category ID must be at least 1.',
        ];
    }

}

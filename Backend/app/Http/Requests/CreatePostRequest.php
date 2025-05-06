<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreatePostRequest extends FormRequest
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
            'title' => 'required|string|min:3|max:128',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'image_1' => 'required|string',
            'image_2' => 'sometimes|string',
            'image_3' => 'sometimes|string',
            'image_4' => 'sometimes|string',
            'image_5' => 'sometimes|string',
            'is_repair' => 'required|boolean',
            'category_id' => 'required|integer',
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'The title is required.',
            'title.string' => 'The title must be a string.',
            'title.min' => 'The title must be at least 3 characters long.',
            'title.max' => 'The title may not be greater than 128 characters.',

            'description.required' => 'The description is required.',
            'description.string' => 'The description must be a string.',

            'price.required' => 'The price is required.',
            'price.decimal' => 'The price must be a valid decimal number (e.g., 19.99).',
            'price.min' => 'The price must be at least 0.',

            'image_1.required' => 'At least one image is required.',
            'image_1.string' => 'The link must be a string.',

            'image_2.string' => 'The link must be a string.',
            'image_3.string' => 'The link must be a string.',
            'image_4.string' => 'The link must be a string.',
            'image_5.string' => 'The link must be a string.',

            'is_repair.required' => 'The repair flag is required.',
            'is_repair.boolean' => 'The repair flag must be true or false.',

            'category_id.required' => 'The category is required.',
            'category_id.integer' => 'The category ID must be an integer.',
        ];
    }
}

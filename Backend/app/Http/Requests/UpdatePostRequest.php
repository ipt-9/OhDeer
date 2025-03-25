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
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'sometimes|string|min:3',
            'description' => 'sometimes|string',
            'price' => 'sometimes|decimal:2,4',
            'is_repair' => 'sometimes|boolean',
            'category_id' => 'sometimes|numeric|exists:categories,id',
        ];
    }
}

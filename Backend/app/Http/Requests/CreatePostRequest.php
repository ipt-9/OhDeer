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
            'title' => 'required|string|min:3',
            'description' => 'required|string',
            'price' => 'required|decimal:2,4',
            'is_repair' => 'required|boolean',
            'category_id' => 'required|numeric|exists:categories,id',
            'customer_id' => 'required|numeric|exists:customers,id',
        ];
    }
}

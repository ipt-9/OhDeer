<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreatePurchaseRequest extends FormRequest
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
            'amount' => 'required|integer|min:0',
            'post_id' => 'required|integer',
            'is_outstanding' => 'required|boolean',
        ];
    }

    public function messages(): array
    {
        return [
            'amount.required' => 'The amount is required.',
            'amount.integer' => 'The amount must be an integer.',
            'amount.min' => 'The amount cannot be negative.',

            'post_id.required' => 'The post ID is required.',
            'post_id.integer' => 'The post ID must be an integer.',
            'post_id.exists' => 'The post ID must refer to an existing post.',

            'fee_id.required' => 'The fee ID is required.',
            'fee_id.integer' => 'The fee ID must be an integer.',
            'fee_id.exists' => 'The fee ID must refer to an existing fee.',

            'is_outstanding.required' => 'You must specify if the purchase is outstanding.',
            'is_outstanding.boolean' => 'The outstanding status must be true or false.',
        ];
    }

}

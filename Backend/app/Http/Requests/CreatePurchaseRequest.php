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
            'amount' => 'required|numeric|min:1',
            //'timestamp' => now(),
            //'date',
            //'is_outstanding' => 'true',
            'repair_rating' => 'required|numeric|between:1,5',
            'general_rating' => 'required|numeric|between:1,5',
            'rating_comment' => 'nullable|string',
            'post_id' => 'required|integer|exists:posts,id',
            //'user_id' => 'required|integer|exists:users,id',
            'fee_id '=> 'required|integer|exists:users,id'
        ];
    }
}

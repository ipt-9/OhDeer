<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePurchaseRequest extends FormRequest
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
            'repair_rating' => 'sometimes|integer|min:1|max:5',
            'general_rating' => 'sometimes|integer|min:1|max:5',
            'rating_comment' => 'sometimes|string|max:1000', // 'text' isn't a valid rule; replaced with 'string' + optional max length
        ];
    }

    public function messages(): array
    {
        return [
            'repair_rating.integer' => 'The repair rating must be a number.',
            'repair_rating.min' => 'The repair rating must be at least :min.',
            'repair_rating.max' => 'The repair rating may not be greater than :max.',

            'general_rating.integer' => 'The general rating must be a number.',
            'general_rating.min' => 'The general rating must be at least :min.',
            'general_rating.max' => 'The general rating may not be greater than :max.',

            'rating_comment.string' => 'The comment must be a valid text.',
            'rating_comment.max' => 'The comment may not be longer than :max characters.',
        ];
    }

}

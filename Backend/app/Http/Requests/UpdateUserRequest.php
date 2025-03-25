<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
            'username' => 'sometimes|string|min:3',
            'password' => 'sometimes|min:6',
            'email' => 'sometimes|string|email',
            'repair_rating' => 'sometimes|integer|between:1,5',
            'general_rating' => 'sometimes|integer|between:1,5',
            'address' => 'sometimes|string',
            'phone_number' => 'sometimes|integer',
            'iban' => 'sometimes|string',
            'user_type_id' => 'sometimes|integer|exists:user_type,id',
            'language_id' => 'sometimes|integer|exists:language,id',
            'subscription_id' => 'sometimes|integer|exists:subscription,id',
        ];
    }
}

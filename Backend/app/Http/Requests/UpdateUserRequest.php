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
            'password' => 'sometimes|min:8',
            'email' => 'sometimes|string|email',
            'repair_rating' => 'sometimes|integer',
            'general_rating' => 'sometimes|integer',
            'address' => 'sometimes|string',
            'postal_code' => 'sometimes|integer',
            'phone_number' => 'sometimes|string',
            'iban' => 'sometimes|string',
            'user_type_id' => 'sometimes|integer',
            'language_id' => 'sometimes|integer',
            'subscription_id' => 'sometimes|integer',
        ];
    }
}

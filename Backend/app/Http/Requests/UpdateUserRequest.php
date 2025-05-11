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
            'username' => 'sometimes|string|min:3|max:50',
            'password' => 'sometimes|string|min:8',
            'email' => 'sometimes|string|email|max:75',
            'address' => 'sometimes|string|max:100',
            'postal_code' => 'sometimes|integer|min:0',
            'phone_number' => 'sometimes|string|max:50',
            'iban' => 'sometimes|string|max:40',
            'website' => 'sometimes|string|max:500',
            'user_type_id' => 'sometimes|integer|min:1',
            'language_id' => 'sometimes|integer|min:1',
            'subscription_id' => 'sometimes|integer|min:1',
            'profile_image' => 'sometimes|string'
        ];
    }

    public function messages(): array
    {
        return [
            'username.string' => 'Username must be a string.',
            'username.min' => 'Username must be at least 3 characters long.',
            'username.max' => 'Username cannot be longer than 50 characters.',

            'password.string' => 'Password must be a string.',
            'password.min' => 'Password must be at least 8 characters long.',

            'email.string' => 'Email must be a string.',
            'email.email' => 'Please enter a valid email address.',
            'email.max' => 'Email cannot be longer than 75 characters.',

            'address.string' => 'Address must be a string.',
            'address.max' => 'Address cannot be longer than 100 characters.',

            'postal_code.integer' => 'Postal code must be an integer.',
            'postal_code.min' => 'Postal code must be a positive number.',

            'phone_number.string' => 'Phone number must be a string.',
            'phone_number.max' => 'Phone number cannot be longer than 50 characters.',

            'iban.string' => 'IBAN must be a string.',
            'iban.max' => 'IBAN cannot be longer than 40 characters.',

            'website.string' => 'Website must be a string.',
            'website.max' => 'Website link cannot be longer than 100 characters.',

            'user_type_id.integer' => 'User type must be an integer.',
            'user_type_id.min' => 'User type ID must be at least 1.',

            'language_id.integer' => 'Language must be an integer.',
            'language_id.min' => 'Language ID must be at least 1.',

            'subscription_id.integer' => 'Subscription must be an integer.',
            'subscription_id.min' => 'Subscription ID must be at least 1.',
        ];
    }


}

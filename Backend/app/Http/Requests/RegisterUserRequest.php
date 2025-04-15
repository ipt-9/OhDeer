<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterUserRequest extends FormRequest
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
            'username' => 'required|string|max:50',
            'password' => 'required|string',
            'postal_code' => 'required|integer|min:0',
            'email' => 'required|string|email|max:75',
            'address' => 'required|string|max:100',
            'phone_number' => 'string|max:50',
            'iban' => 'string|max:40',
        ];
    }

    public function messages(): array
    {
        return [
            'username.required' => 'Username is required.',
            'username.string' => 'Username must be a string.',
            'username.max' => 'Username cannot be longer than 50 characters.',

            'password.required' => 'Password is required.',
            'password.string' => 'Password must be a string.',

            'postal_code.required' => 'Postal code is required.',
            'postal_code.integer' => 'Postal code must be an integer.',
            'postal_code.min' => 'Postal code must be a positive number.',

            'email.required' => 'Email is required.',
            'email.string' => 'Email must be a string.',
            'email.email' => 'Please enter a valid email address.',
            'email.max' => 'Email cannot be longer than 75 characters.',

            'repair_rating.required' => 'Repair rating is required.',
            'repair_rating.integer' => 'Repair rating must be an integer.',
            'repair_rating.min' => 'Repair rating must be a non-negative number.',

            'general_rating.required' => 'General rating is required.',
            'general_rating.integer' => 'General rating must be an integer.',
            'general_rating.min' => 'General rating must be a non-negative number.',

            'address.required' => 'Address is required.',
            'address.string' => 'Address must be a string.',
            'address.max' => 'Address cannot be longer than 100 characters.',

            'phone_number.string' => 'Phone number must be a string.',
            'phone_number.max' => 'Phone number cannot be longer than 50 characters.',

            'iban.string' => 'IBAN must be a string.',
            'iban.max' => 'IBAN cannot be longer than 40 characters.',
        ];
    }

}

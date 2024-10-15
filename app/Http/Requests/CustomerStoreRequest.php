<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CustomerStoreRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'first_name' =>'required|max:255',
            'last_name' =>'required|max:255',
            'date_of_birth' =>'required|date',
            'phone_number' =>'required|max:20',
            'email' =>'required|email',
            'card_number' =>'required|max:20',
            'image' =>'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ];
    }
}

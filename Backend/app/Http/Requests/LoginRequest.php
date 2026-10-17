<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'email' => ['required', 'email:rfc'],
            'password' => ['required', 'string', 'min:6'],
        ];
    }

    public function messages(): array
    {
        return [
            'email.required' => 'እባክዎ ኢሜይል ያስገቡ (Email is required).',
            'email.email' => 'እባክዎ ትክክለኛ የኢሜይል ቅርጸት ያስገቡ (Valid email is required).',
            'password.required' => 'እባክዎ የይለፍ ቃል ያስገቡ (Password is required).',
            'password.min' => 'የይለፍ ቃል ቢያንስ 6 ፊደላት መሆን አለበት (Password must be at least 6 characters).',
        ];
    }
}

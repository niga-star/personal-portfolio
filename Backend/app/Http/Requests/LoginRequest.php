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
            'email' => ['required', 'string', 'email:rfc', 'max:150'],
            'password' => ['required', 'string', 'min:6', 'max:100'],
        ];
    }

    public function messages(): array
    {
        return [
            'email.required' => 'እባክዎ ኢሜይል ያስገቡ (Email address is required).',
            'email.email' => 'እባክዎ ትክክለኛ የኢሜይል ቅርጸት ያስገቡ (Valid email format required, e.g. admin@portfolio.com).',
            'email.max' => 'ኢሜይል ከ150 ፊደላት መብለጥ የለበትም (Email cannot exceed 150 characters).',
            'password.required' => 'እባክዎ የይለፍ ቃል ያስገቡ (Password is required).',
            'password.min' => 'የይለፍ ቃል ቢያንስ 6 ፊደላት መሆን አለበት (Password must be at least 6 characters).',
            'password.max' => 'የይለፍ ቃል ከ100 ፊደላት መብለጥ የለበትም (Password cannot exceed 100 characters).',
        ];
    }
}

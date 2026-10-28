<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ChangePasswordRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'current_password' => ['required', 'string', 'current_password'],
            'new_password' => ['required', 'string', 'min:8', 'max:100', 'confirmed', 'different:current_password'],
        ];
    }

    public function messages(): array
    {
        return [
            'current_password.required' => 'እባክዎ አሁን ያለውን የይለፍ ቃል ያስገቡ (Current password is required).',
            'current_password.current_password' => 'አሁን ያስገቡት የይለፍ ቃል ትክክል አይደለም (Current password does not match).',
            'new_password.required' => 'እባክዎ አዲስ የይለፍ ቃል ያስገቡ (New password is required).',
            'new_password.min' => 'አዲሱ የይለፍ ቃል ቢያንስ 8 ፊደላት መሆን አለበት (New password must be at least 8 characters).',
            'new_password.max' => 'አዲሱ የይለፍ ቃል ከ100 ፊደላት መብለጥ የለበትም (New password cannot exceed 100 characters).',
            'new_password.confirmed' => 'የይለፍ ቃል ማረጋገጫው አልተመሳሰለም (Password confirmation does not match).',
            'new_password.different' => 'አዲሱ የይለፍ ቃል ከአሮጌው የተለየ መሆን አለበት (New password must be different from current password).',
        ];
    }
}

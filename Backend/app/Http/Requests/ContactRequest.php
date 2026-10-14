<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:150'],
            'email' => ['required', 'email:rfc', 'max:150'],
            'project_type' => ['nullable', 'string', 'max:100'],
            'budget_range' => ['nullable', 'string', 'max:100'],
            'message' => ['required', 'string', 'min:10', 'max:5000'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'እባክዎ ስምዎን ያስገቡ (Please provide your name).',
            'email.required' => 'እባክዎ ትክክለኛ ኢሜይል ያስገቡ (Valid email is required).',
            'message.required' => 'እባክዎ መልዕክትዎን ያስገቡ (Please include your message).',
            'message.min' => 'መልዕክትዎ ቢያንስ 10 ፊደላት መሆን አለበት (Message must be at least 10 characters).',
        ];
    }
}

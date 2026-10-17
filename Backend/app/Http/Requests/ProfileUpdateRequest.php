<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'brand_name' => ['sometimes', 'string', 'max:100'],
            'developer_name' => ['sometimes', 'string', 'max:255'],
            'status_badge' => ['sometimes', 'string', 'max:255'],
            'tagline' => ['sometimes', 'string', 'max:255'],
            'hero_title' => ['sometimes', 'string', 'max:255'],
            'hero_subtitle' => ['sometimes', 'string'],
            'about_heading' => ['sometimes', 'string', 'max:255'],
            'about_lead' => ['sometimes', 'string'],
            'about_bio' => ['sometimes', 'string'],
            'avatar_url' => ['sometimes', 'nullable', 'string', 'max:500'],
            'cv_url' => ['sometimes', 'nullable', 'string', 'max:500'],
            'email' => ['sometimes', 'email:rfc', 'max:255'],
            'github_url' => ['sometimes', 'nullable', 'string', 'max:500'],
            'linkedin_url' => ['sometimes', 'nullable', 'string', 'max:500'],
            'telegram_url' => ['sometimes', 'nullable', 'string', 'max:500'],
            'twitter_url' => ['sometimes', 'nullable', 'string', 'max:500'],
            'stats' => ['sometimes', 'array'],
        ];
    }

    public function messages(): array
    {
        return [
            'email.email' => 'እባክዎ ትክክለኛ ኢሜይል ያስገቡ (Valid email is required).',
        ];
    }
}

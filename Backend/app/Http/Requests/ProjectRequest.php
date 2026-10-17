<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProjectRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $isPost = $this->isMethod('post');

        return [
            'title' => [$isPost ? 'required' : 'sometimes', 'string', 'max:255'],
            'category' => [$isPost ? 'required' : 'sometimes', 'string', 'max:100'],
            'summary' => [$isPost ? 'required' : 'sometimes', 'string', 'max:500'],
            'description' => [$isPost ? 'required' : 'sometimes', 'string'],
            'problem_solved' => ['nullable', 'string'],
            'database_architecture' => ['nullable', 'string'],
            'thumbnail_url' => ['nullable', 'string', 'max:500'],
            'live_demo_url' => ['nullable', 'string', 'max:500'],
            'github_url' => ['nullable', 'string', 'max:500'],
            'is_featured' => ['boolean'],
            'sort_order' => ['integer'],
            'skill_ids' => ['nullable', 'array'],
            'skill_ids.*' => ['exists:skills,id'],
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'እባክዎ የፕሮጀክቱን ርዕስ ያስገቡ (Project title is required).',
            'title.max' => 'የፕሮጀክት ርዕስ ከ255 ፊደላት መብለጥ የለበትም (Title max 255 characters).',
            'category.required' => 'እባክዎ የፕሮጀክት ምድብ ይምረጡ (Project category is required).',
            'summary.required' => 'እባክዎ አጭር ማጠቃለያ ያስገቡ (Summary is required).',
            'summary.max' => 'ማጠቃለያው ከ500 ፊደላት መብለጥ የለበትም (Summary max 500 characters).',
            'description.required' => 'እባክዎ ዝርዝር መግለጫ ያስገቡ (Description is required).',
            'thumbnail_url.url' => 'ትክክለኛ የፎቶ URL ያስገቡ (Valid thumbnail URL is required).',
            'live_demo_url.url' => 'ትክክለኛ የቀጥታ ማሳያ URL ያስገቡ (Valid demo URL is required).',
            'github_url.url' => 'ትክክለኛ የGitHub URL ያስገቡ (Valid GitHub URL is required).',
            'skill_ids.*.exists' => 'የተመረጠው ክህሎት በዳታቤዝ ውስጥ አልተገኘም (Selected skill not found).',
        ];
    }
}

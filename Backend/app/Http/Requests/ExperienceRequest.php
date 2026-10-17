<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ExperienceRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $isPost = $this->isMethod('post');

        return [
            'period' => [$isPost ? 'required' : 'sometimes', 'string', 'max:100'],
            'role_title' => [$isPost ? 'required' : 'sometimes', 'string', 'max:255'],
            'institution' => [$isPost ? 'required' : 'sometimes', 'string', 'max:255'],
            'type' => [$isPost ? 'required' : 'sometimes', 'in:career,education'],
            'description' => ['nullable', 'string'],
            'sort_order' => ['nullable', 'integer'],
        ];
    }

    public function messages(): array
    {
        return [
            'period.required' => 'እባክዎ የጊዜ ሰሌዳውን ያስገቡ (Period is required, e.g. 2022 - 2024 or Present).',
            'role_title.required' => 'እባክዎ የስራ መደብ ወይም የትምህርት ደረጃ ያስገቡ (Role title is required).',
            'institution.required' => 'እባክዎ የተቋሙን ወይም የድርጅቱን ስም ያስገቡ (Institution/Company is required).',
            'type.required' => 'እባክዎ አይነት ይምረጡ (Type is required).',
            'type.in' => 'አይነቱ career ወይም education መሆን አለበት (Type must be career or education).',
        ];
    }
}

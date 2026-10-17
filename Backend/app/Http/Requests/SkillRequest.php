<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SkillRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $skillId = $this->route('id');
        $isPost = $this->isMethod('post');

        return [
            'name' => [
                $isPost ? 'required' : 'sometimes',
                'string',
                'max:100',
                Rule::unique('skills', 'name')->ignore($skillId),
            ],
            'category' => [
                $isPost ? 'required' : 'sometimes',
                'in:backend,frontend,database,tools',
            ],
            'proficiency_percentage' => [
                $isPost ? 'required' : 'sometimes',
                'integer',
                'min:1',
                'max:100',
            ],
            'icon_class' => ['nullable', 'string', 'max:100'],
            'sort_order' => ['nullable', 'integer'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'እባክዎ የክህሎቱን ስም ያስገቡ (Skill name is required).',
            'name.unique' => 'ይህ ክህሎት አስቀድሞ ተመዝግቧል (Skill name already exists).',
            'category.required' => 'እባክዎ ምድብ ይምረጡ (Skill category is required).',
            'category.in' => 'ምድቡ backend, frontend, database ወይም tools መሆን አለበት (Invalid category).',
            'proficiency_percentage.required' => 'እባክዎ የብቃት ደረጃውን ያስገቡ (Proficiency percentage is required).',
            'proficiency_percentage.min' => 'የብቃት ደረጃ ቢያንስ 1% መሆን አለበት (Proficiency min is 1%).',
            'proficiency_percentage.max' => 'የብቃት ደረጃ ከ100% መብለጥ አይችልም (Proficiency max is 100%).',
        ];
    }
}

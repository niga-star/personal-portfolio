<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FileUploadRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'file' => [
                'required',
                'file',
                'mimes:jpeg,png,jpg,webp,gif,svg,pdf',
                'max:10240', // 10MB
            ],
            'folder' => ['nullable', 'string', 'in:thumbnails,avatars,cv,general'],
        ];
    }

    public function messages(): array
    {
        return [
            'file.required' => 'እባክዎ የሚጫን ፋይል ይምረጡ (Please select a file to upload).',
            'file.file' => 'የተመረጠው መረጃ ትክክለኛ ፋይል አይደለም (Uploaded item must be a valid file).',
            'file.mimes' => 'የተፈቀዱ የፋይል አይነቶች jpeg, png, jpg, webp, gif, svg ወይም pdf ብቻ ናቸው (Allowed formats: jpeg, png, jpg, webp, gif, svg, pdf).',
            'file.max' => 'የፋይሉ መጠን ከ10MB መብለጥ የለበትም (Maximum file size is 10MB).',
        ];
    }
}

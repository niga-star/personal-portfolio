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
            // 1. Name: only letters and spaces, between 3 and 30 characters
            'name' => [
                'required',
                'string',
                'min:3',
                'max:30',
                'regex:/^[\pL\s]+$/u',
            ],

            // 2. Email: valid RFC format, rejection of fake/disposable domains, and DNS verification where possible
            'email' => [
                'required',
                'string',
                'max:150',
                'email:rfc',
                function ($attribute, $value, $fail) {
                    // Strict format check for proper domain and TLD
                    $emailRegex = '/^[a-zA-Z0-9.!#$%&\'*+\/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)+$/';
                    if (!preg_match($emailRegex, $value)) {
                        $fail('እባክዎ ትክክለኛ የኢሜይል ቅርጸት ያስገቡ (Please provide a valid email format, e.g. name@domain.com).');
                        return;
                    }

                    $parts = explode('@', $value);
                    if (count($parts) !== 2) {
                        $fail('የተሳሳተ የኢሜይል አድራሻ (Invalid email address).');
                        return;
                    }

                    $domain = strtolower(trim($parts[1]));

                    // Block known disposable / temporary email services
                    $disposableDomains = [
                        'mailinator.com', 'tempmail.com', '10minutemail.com', 'guerrillamail.com',
                        'trashmail.com', 'yopmail.com', 'throwawaymail.com', 'dispostable.com',
                        'fakeinbox.com', 'sharklasers.com', 'temp-mail.org', 'getairmail.com',
                        'burnermail.io', 'mytemp.email', 'crazymailing.com', 'generator.email',
                        'maildrop.cc', 'inboxkitten.com', 'dropmail.me', 'mohmal.com',
                    ];

                    if (in_array($domain, $disposableDomains, true)) {
                        $fail('ጊዜያዊ ወይም የማይሰራ ኢሜይል መጠቀም አይቻልም፤ እባክዎ እውነተኛ ኢሜይል ያስገቡ (Disposable or temporary emails are rejected. Please use a real email address).');
                        return;
                    }

                    // Check for common typos in popular providers
                    $typoMap = [
                        'gmial.com' => 'gmail.com',
                        'gamil.com' => 'gmail.com',
                        'gmai.com' => 'gmail.com',
                        'hotmial.com' => 'hotmail.com',
                        'yaho.com' => 'yahoo.com',
                        'outlok.com' => 'outlook.com',
                    ];

                    if (isset($typoMap[$domain])) {
                        $fail("የኢሜይል ዶሜይኑ የተሳሳተ ይመስላል፤ ወደ @{$typoMap[$domain]} ማስተካከል ፈልገው ነበር? (Did you mean @{$typoMap[$domain]}?)");
                        return;
                    }

                    // Perform real email DNS domain check where possible (if online and function exists)
                    if (function_exists('checkdnsrr') && !app()->runningUnitTests()) {
                        // Skip local/test domains
                        if (!in_array($domain, ['localhost', 'example.com', 'test.com', 'example.org'], true)) {
                            $hasMx = @checkdnsrr($domain, 'MX');
                            $hasA = @checkdnsrr($domain, 'A');
                            if (!$hasMx && !$hasA) {
                                $fail('የኢሜይል አድራሻው ዶሜይን ትክክል አይደለም ወይም መልዕክት መቀበል አይችልም (The email domain does not exist or cannot receive mail).');
                            }
                        }
                    }
                },
            ],

            'project_type' => ['nullable', 'string', 'max:100'],
            'budget_range' => ['nullable', 'string', 'max:100'],

            // 3. Message: minimum 15 characters required
            'message' => [
                'required',
                'string',
                'min:15',
                'max:5000',
            ],
        ];
    }

    /**
     * Custom validation error messages
     */
    public function messages(): array
    {
        return [
            // Name messages
            'name.required' => 'እባክዎ ስምዎን ያስገቡ (Please enter your name).',
            'name.string' => 'ስም ትክክለኛ ጽሁፍ መሆን አለበት (Name must be a valid text).',
            'name.min' => 'ስም ቢያንስ 3 ፊደላት መሆን አለበት (Name must contain at least 3 characters).',
            'name.max' => 'ስም ከ30 ፊደላት መብለጥ የለበትም (Name cannot exceed 30 characters).',
            'name.regex' => 'ስም ፊደላትን እና ክፍተትን (spaces) ብቻ መያዝ አለበት፤ ቁጥሮች እና ምልክቶች አይፈቀዱም (Name must contain only letters and spaces, not numbers or special characters).',

            // Email messages
            'email.required' => 'እባክዎ ትክክለኛ የኢሜይል አድራሻ ያስገቡ (Please enter a valid email address).',
            'email.email' => 'እባክዎ ትክክለኛ የኢሜይል ቅርጸት ያስገቡ (Valid email format required, e.g. name@domain.com).',
            'email.max' => 'የኢሜይል አድራሻው በጣም ረጅም ነው (Email address is too long).',

            // Message messages
            'message.required' => 'እባክዎ መልዕክትዎን ያስገቡ (Please write your message).',
            'message.string' => 'መልዕክት ትክክለኛ ጽሁፍ መሆን አለበት (Message must be text).',
            'message.min' => 'መልዕክትዎ ቢያንስ 15 ፊደላት መሆን አለበት፤ እባክዎ ዝርዝር መረጃ ይጻፉ (Message must contain at least 15 characters).',
            'message.max' => 'መልዕክትዎ ከ5000 ፊደላት መብለጥ የለበትም (Message cannot exceed 5000 characters).',
        ];
    }
}

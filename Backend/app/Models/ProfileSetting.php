<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfileSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'brand_name',
        'developer_name',
        'status_badge',
        'tagline',
        'hero_title',
        'hero_subtitle',
        'about_heading',
        'about_lead',
        'about_bio',
        'avatar_url',
        'cv_url',
        'email',
        'github_url',
        'linkedin_url',
        'telegram_url',
        'twitter_url',
        'stats',
    ];

    protected $casts = [
        'stats' => 'array',
    ];
}

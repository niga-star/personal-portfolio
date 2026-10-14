<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'category',
        'slug',
        'summary',
        'description',
        'problem_solved',
        'database_architecture',
        'thumbnail_url',
        'live_demo_url',
        'github_url',
        'is_featured',
        'sort_order',
    ];

    protected $casts = [
        'is_featured' => 'boolean',
        'sort_order' => 'integer',
    ];

    public function skills(): BelongsToMany
    {
        return $this->belongsToMany(Skill::class, 'project_skill')->withTimestamps();
    }
}

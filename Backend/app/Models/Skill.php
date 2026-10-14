<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Skill extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'category',
        'proficiency_percentage',
        'icon_class',
        'sort_order',
    ];

    protected $casts = [
        'proficiency_percentage' => 'integer',
        'sort_order' => 'integer',
    ];

    public function projects(): BelongsToMany
    {
        return $this->belongsToMany(Project::class, 'project_skill')->withTimestamps();
    }
}

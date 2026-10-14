<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $fillable = [
        'sender_name',
        'sender_email',
        'project_type',
        'budget_range',
        'message',
        'is_read',
        'ip_address',
    ];

    protected $casts = [
        'is_read' => 'boolean',
    ];
}

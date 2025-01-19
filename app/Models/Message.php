<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory, HasUuids;

    protected $casts = [
        'channels' => 'array',
        'scheduled_at' => 'datetime',
        'delivered_at' => 'datetime',
        'read_at' => 'datetime',
        'is_public' => 'boolean',
    ];

    protected $fillable = [
        'user_id',
        'content',
        'channels',
        'scheduled_at',
        'delivered_at',
        'read_at',
        'is_public',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

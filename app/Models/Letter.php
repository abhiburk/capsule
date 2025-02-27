<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Letter extends Model
{
    use HasFactory, HasUuids, SoftDeletes;

    protected $casts = [
        'channels' => 'array',
        'scheduled_at' => 'datetime',
        'scheduled_at' => 'datetime',
        'read_at' => 'datetime',
        'is_public' => 'boolean',
    ];

    protected $guarded = [
        'id'
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($letter) {
            $letter->title = 'A letter from ' . now()->format('M d, Y');
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function capsule()
    {
        return $this->belongsTo(Capsule::class);
    }

    public function recipients()
    {
        return $this->hasMany(Recipient::class);
    }
}

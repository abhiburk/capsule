<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Capsule extends Model
{
    use HasFactory, HasUuids, HasSlug, SoftDeletes;

    protected $guarded = [
        'id',
    ];

    protected $appends = [
        'visibility_name',
    ];

    public function getVisibilityNameAttribute()
    {
        return $this->attributes['visibility'] ? 'Public' : 'Private';
    }

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()->generateSlugsFrom('name')->saveSlugsTo('slug');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function letters()
    {
        return $this->hasMany(Letter::class);
    }
}

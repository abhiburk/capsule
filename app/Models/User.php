<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasUuids;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    protected static function booted(): void
    {
        static::created(function ($user) {
            $user->createDefaultCapsule();
        });
    }

    public function letters()
    {
        return $this->hasMany(Letter::class);
    }

    public function capsules()
    {
        return $this->hasMany(Capsule::class);
    }

    public function createDefaultCapsule()
    {
        return $this->capsules()->create([
            'title' => 'default',
            'description' => 'default public capsule',
            'visibility' => 0,
            'is_default' => 1,
        ]);
    }

    public function default_capsule(): Capsule
    {
        return $this->capsules()->where('is_default', 1)->first();
    }
}

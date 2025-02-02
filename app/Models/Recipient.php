<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Recipient extends Model
{
    use HasUuids;

    protected $guarded = [
        'id'
    ];

    public function letter()
    {
        return $this->belongsTo(Letter::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KeyWord extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'term',
        'status',
    ];

    protected $appends = ['replay_count'];

    public function getReplayCountAttribute()
    {
        return 0;
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Msg extends Model
{
    use HasFactory;

    protected $fillable = [
        'sender_phone', 'receiver_phone', 'message', 'room_id', 'date',
    ];
}

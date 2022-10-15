<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Msg extends Model
{
    use HasFactory;

    protected $fillable = [
        'sender_phone', 'sender_name', 'receiver_phone', 'receiver_name', 'message', 'room_id', 'sent_at',
    ];
}

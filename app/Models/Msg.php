<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Msg extends Model
{
    use HasFactory;

    protected $fillable = [
        'payload_id', 'room_id', 'sender_phone', 'sender_name', 'receiver_phone', 'receiver_name', 'message', 'occurred_at',
    ];

    public function user() {
        // return $this->belongsTo(User::class, 'user_id', 'id');
    }
}

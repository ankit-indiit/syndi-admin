<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Msg extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'payload_id', 'room_id', 'sender_phone', 'sender_name', 'receiver_phone', 'receiver_name', 
        'message', 'units', 'emoji', 'read', 'schedule_at', 'schedule_sent', 'created_at', 'updated_at',
    ];

    public function user(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function img(){
        return $this->hasMany(Img::class);
    }
}

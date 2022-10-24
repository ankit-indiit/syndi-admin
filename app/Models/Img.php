<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Img extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'msg_id', 'type', 'img_url'
    ];

    public function linked_user() {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function linked_msg() {
        return $this->belongsTo(Msg::class, 'msg_id', 'id');
    }

}

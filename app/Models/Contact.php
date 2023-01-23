<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'phone_number', 'first_name', 'last_name', 'email', 'note', 'group_ids', 'status', 'block'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'status', 'block',
    ];

    public function user() {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function getCreatedAtAttribute()
    {
        return date('d/F/Y', strtotime($this->attributes['created_at']));
    }
}

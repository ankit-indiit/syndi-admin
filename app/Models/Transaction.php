<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'payment_id', 'amount', 'units', 'type', 'currency',
    ];

    public function user(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}

<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;
use Nikolag\Square\Traits\HasCustomers;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasCustomers;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'account_id', 'full_name', 'email', 'email_verified_at', 'company', 'group', 'phone', 'timezone', 'role','password', 'dpassword', 
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'dpassword', 
    ];

    public function msg() {
        return $this->hasMany(Msg::class);
    }
    public function user_images() {
        return $this->hasMany(Img::class);
    }

}
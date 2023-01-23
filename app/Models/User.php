<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'account_id',
        'full_name',
        'email',
        'email_verified_at',
        'company',
        'group',
        'phone',
        'timezone',
        'role',
        'password',
        'dpassword',
        'image',
        'status',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'dpassword', 
    ];

    protected $appends = ['status_badge'];

    public function getImageAttribute()
    {
        if ($this->attributes['image'] == '') {
            return asset("https://ui-avatars.com/api/?name=".@$this->attributes['full_name']."");
        } else {
            return asset('assets/admin/images/users').'/'.$this->attributes['image'];
        }
    }

    public function getStatusBadgeAttribute()
    {
        if (isset($this->attributes['status'])) {
            switch ($this->attributes['status']) {
                case 0:
                    return '<span class="badge badge-soft-danger">Inactive</span>';
                break;
                case 1:
                    return '<span class="badge badge-soft-success">Active</span>';
                break;           
            }        
        }
    }

    public function msg() {
        return $this->hasMany(Msg::class);
    }
    public function user_images() {
        return $this->hasMany(Img::class);
    }
    public function transactions() {
        return $this->hasMany(Transaction::class);
    }
    public function units() {
        return $this->hasOne(Unit::class);
    }
    public function contacts() {
        return $this->hasMany(Contact::class);
    }
    public function groups() {
        return $this->hasMany(Group::class);
    }
}
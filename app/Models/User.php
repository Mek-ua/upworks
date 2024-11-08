<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role_id',
        'full_name',
    ];

    protected $hidden = [
        'password',
        'remember_token',
        'createToken'
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function client()
    {
        return $this->hasOne(Client::class, 'user_id','full_name');
    }

    public function freelancer()
    {
        return $this->hasOne(Freelancer::class, 'user_id','full_name');
    }
}

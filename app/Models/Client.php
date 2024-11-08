<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;
 
    protected $fillable = [
        'user_id', 
        'phone_number', 
        'status', 
        'address_id'
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function address()
    {
        return $this->belongsTo(Address::class);
    }

    public function jobPosts()
    {
        return $this->hasMany(JobPost::class);
    }

    public function notifications()
    {
        return $this->hasMany(Notification::class);
    }

    public function sentChats()
    {
        return $this->hasMany(Chat::class, 'sender_client_id');
    }

    public function receivedChats()
    {
        return $this->hasMany(Chat::class, 'receiver_client_id');
    }
    public function contracts()
    {
        return $this->hasMany(Contract::class);
    }
}
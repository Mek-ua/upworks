<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Freelancer extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 
        'full_name', 
        'portfolio', 
        'skills', 
        'experience', 
        'address_id', 
        'status', 
        'educational_status_id'
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function address()
    {
        return $this->belongsTo(Address::class);
    }

    public function educationalStatus()
    {
        return $this->belongsTo(EducationalStatus::class);
    }

    public function skills()
    {
        return $this->belongsToMany(Skill::class, 'freelancer_skills','freelancer_id', 'skill_id');
    }

    public function jobApplies()
    {
        return $this->hasMany(JobApply::class);
    }

    public function notifications()
    {
        return $this->hasMany(Notification::class);
    }

    public function sentChats()
    {
        return $this->hasMany(Chat::class, 'sender_freelancer_id');
    }

    public function receivedChats()
    {
        return $this->hasMany(Chat::class, 'receiver_freelancer_id');
    }
    public function contracts()
    {
        return $this->hasMany(Contract::class);
    }
}
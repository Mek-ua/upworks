<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FreelancerSkill extends Model
{
    public function freelancer()
    {
        return $this->belongsTo(Freelancer::class);
    }

    public function skill()
    {
        return $this->belongsTo(Skill::class);
    }
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobApply extends Model
{
    use HasFactory;

    public function jobPost()
    {
        return $this->belongsTo(JobPost::class);
    }

    public function freelancer()
    {
        return $this->belongsTo(Freelancer::class);
    }
    public function contract()
    {
        return $this->hasOne(Contract::class);
    }
}
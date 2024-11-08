<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobPost extends Model
{
    use HasFactory;

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function jobApplies()
    {
        return $this->hasMany(JobApply::class);
    }
    public function contracts()
    {
        return $this->hasMany(Contract::class);
    }
}
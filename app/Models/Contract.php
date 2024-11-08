<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{
    use HasFactory;

    public function jobApply()
    {
        return $this->belongsTo(JobApply::class);
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function freelancer()
    {
        return $this->belongsTo(Freelancer::class);
    }
    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function rating()
    {
        return $this->hasOne(Rating::class);
    }
}

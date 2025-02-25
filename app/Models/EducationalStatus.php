<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EducationalStatus extends Model
{
    use HasFactory;

    public function freelancers()
    {
        return $this->hasMany(Freelancer::class);
    }
}
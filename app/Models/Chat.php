<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    use HasFactory;

    public function senderClient()
    {
        return $this->belongsTo(Client::class, 'sender_client_id');
    }

    public function senderFreelancer()
    {
        return $this->belongsTo(Freelancer::class, 'sender_freelancer_id');
    }

    public function receiverClient()
    {
        return $this->belongsTo(Client::class, 'receiver_client_id');
    }

    public function receiverFreelancer()
    {
        return $this->belongsTo(Freelancer::class, 'receiver_freelancer_id');
    }
}
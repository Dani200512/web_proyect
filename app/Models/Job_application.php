<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job_application extends Model
{
    protected $fillable = ['job_offer_id', 'profile_id', 'message', 'status'];

    public function jobOffer()
    {
        return $this->belongsTo(JobOffer::class);
    }

    public function profile()
    {
        return $this->belongsTo(Profile::class);
    }
}



<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job_application extends Model
{
    use HasFactory;

    public function profile()
    {
        return $this->belongsTo('App\Models\Profile');
    }

    public function job_offert(){
        return $this->belongsTo('App\Models\Job_offer');
    }
}



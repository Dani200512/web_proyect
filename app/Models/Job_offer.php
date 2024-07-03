<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job_offer extends Model
{
    use HasFactory;

    public function profile()
    {
        return $this->belongsTo('App\Models\Profile');
    }

    public function post(){
        return $this->belongsTo('App\Models\Post');
    }

    public function job_applications(){
        return $this->hasMany('App\Models\Job_application');
    }
}

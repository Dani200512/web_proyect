<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobOffer extends Model
{
    protected $fillable = ['title', 'description', 'requirements', 'post_id', 'profile_id'];

    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    public function profile()
    {
        return $this->belongsTo(Profile::class);
    }

    public function applications(){
        return $this->hasMany('App\Models\Job_application');
    }
}

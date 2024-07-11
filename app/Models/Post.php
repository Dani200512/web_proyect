<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'publication_type',
        'content',
        'description',
        'profile_id'
    ];

    public function profile()
    {
        return $this->belongsTo(Profile::class);
    }

    public function comments(){
        return $this->hasMany('App\Models\Comment');
    }

    public function reactions(){
        return $this->hasMany('App\Models\Reaction');
    }

    public function multimedias(){
        return $this->hasMany('App\Models\Multimedia');
    }

    public function job_offer(){
        return $this->hasMany('App\Models\Job_offer');
    }

    public function jobOffers()
    {
        return $this->hasMany(JobOffer::class);
    }
}

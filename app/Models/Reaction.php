<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'type_reaction',
        'profile_id',
        'post_id'
    ];

    public function profile(){
        return $this->belongsTo('App\Models\Profile');
    }

    public function post(){
        return $this->belongsTo('App\Models\Post');
    }
}

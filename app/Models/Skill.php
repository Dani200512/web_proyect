<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'icon', 'profile_id'];

    public function profile()
    {
        return $this->belongsTo('App\Models\Profile');
    }
}

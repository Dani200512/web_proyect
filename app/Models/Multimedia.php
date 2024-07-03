<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Multimedia extends Model
{
    use HasFactory;

    public function Post(){
        return $this->belongsTo('App\Models\Post');
    }
}

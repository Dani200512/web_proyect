<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Multimedia extends Model
{
    use HasFactory;

    protected $fillable = ['photo', 'video', 'post_id'];

    public function post()
    {
        return $this->belongsTo(Post::class);
    }
}

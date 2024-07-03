<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    protected $fillable = ['titulo', 'descripcion', 'Archivo_hvida', 'foto_perfil'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function posts(){
        return $this->hasMany('App\Models\Post');
    }

    public function comments(){
        return $this->hasMany('App\Models\Comment');
    }

    public function reactions(){
        return $this->hasMany('App\Models\Reaction');
    }

    public function job_applications(){
        return $this->hasMany('App\Models\Job_application');
    }

    public function job_offerts(){
        return $this->hasMany('App\Models\Job_offer');
    }

    public function skills(){
        return $this->hasMany('App\Models\Skill');
    }

    public function notifications(){
        return $this->hasMany('App\Models\Notification');
    }

    public function califications(){
        return $this->belongsToMany('App\Models\Calification');
    }

    public function friends()
    {
        return $this->belongsToMany('App\Models\Profile', 'frienships', 'id_profile1', 'id_profile2')
            ->withPivot('state')
            ->withTimestamps();
    }

    public function friendsof()
    {
        return $this->belongsToMany('App\Models\Profile', 'frienships', 'id_profile2', 'id_profile1') // Cambiar el orden de id_profile1 e id_profile2
            ->withPivot('state')
            ->withTimestamps();
    }


    public function messages()
    {
        return $this->belongsToMany('App\Models\Profile', 'frienships', 'id_profile1', 'id_profile2')
            ->withPivot('state')
            ->withPivot('content')
            ->withTimestamps();
    }

    public function messagesof()
    {
        return $this->belongsToMany('App\Models\Profile', 'frienships', 'id_profile2', 'id_profile1') // Cambiar el orden de id_profile1 e id_profile2
            ->withPivot('state')
            ->withPivot('content')
            ->withTimestamps();
    }



}

<?php

namespace App\Providers;
use App\Models\Post;
use App\Models\JobOffer;
use Illuminate\Support\Facades\Gate;
use App\Policies\PostPolicy;
use App\Policies\JobOfferPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Post::class => PostPolicy::class,
        JobOffer::class => JobOfferPolicy::class,
    ];



    public function boot()
    {
        $this->registerPolicies();
    }


}
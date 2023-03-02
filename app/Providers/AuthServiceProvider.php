<?php

namespace App\Providers;

use App\Models\User;
use App\Models\Video;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('create-delete-users', function(User $user){
            if($user->role_id === 1)
                return true;
        });

        Gate::define('create-delete-videos', function(User $user){
            if($user->role_id === 1)
                return true;
        });

        Gate::define('edit-videos', function(User $user, Video $video){
            if($user->role_id === 1)
                return true;
            else
                return ($user->id === $video->user_id);
        });
    }
}

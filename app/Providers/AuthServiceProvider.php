<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
        /* User */
        Gate::define('change-password', function($user, $attempt_user){
            return $user->id == $attempt_user->id;
        });
        Gate::define('admin-only', function($user, $attempt_user){
            return $attempt_user->admin == 1;
        });


        Gate::define('edit-shortcut', function($user, $shortcut){
            return $user->id === $shortcut->user_id;
        });
    }
}

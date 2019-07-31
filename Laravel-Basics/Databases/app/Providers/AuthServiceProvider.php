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
        'App\Test' => 'App\Policies\TestPolicy',   // tutaj rejestrujemy zasady
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot(Gate $gate)
    {
        $this->registerPolicies();

        $gate::before(function($user){
            return $user->id === 2;     // przed jakąkolwiek autoryzacją - jeśli id jest 2 zezwól na dostep
        });

        //
    }
}

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
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('superadmin', function ($user) {
            return ($user->rights_id>=10);
        });
        Gate::define('admin', function ($user) {
            return ($user->rights_id>=7);
        });
        Gate::define('manager', function ($user) {
            return ($user->rights_id>=5);
        });
        Gate::define('affilate', function ($user) {
            return ($user->rights_id>=2);
        });
        Gate::define('client', function ($user) {
            return ($user->rights_id>=1);
        });
        Gate::define('fired', function ($user) {
            return ("0" == $user->rights_id);
        });

    }
}

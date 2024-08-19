<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\User;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        // 管理者
        Gate::define('admin', function (User $user) {
        return ($user->role->score === 100);
        });
        // 店舗代表者
        Gate::define('representative', function (User $user) {
        return ($user->role->score >= 50);
        });
        // 利用者
        Gate::define('user', function (User $user) {
        return ($user->role->score === 1);
        });
    }
}

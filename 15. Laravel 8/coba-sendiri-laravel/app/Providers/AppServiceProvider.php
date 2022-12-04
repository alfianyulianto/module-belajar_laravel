<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use App\Models\User;
use Illuminate\Support\Facades\Gate;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Pagination agar tamplatenya bootstrap
        Paginator::useBootstrapFive();

        // Bikin gate untuk authorization
        Gate::define('admin', function (User $user) {
            // return $user->username == 'alfianyulianto';

            // setelah ditambah field baru is_admin 
            return $user->is_admin;
        });
    }
}

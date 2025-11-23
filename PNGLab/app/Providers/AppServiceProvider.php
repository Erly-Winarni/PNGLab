<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }

    public static function redirectToByRole($user)
    {
        return match ($user->role) {
            'admin'   => '/dashboard/admin',
            'teacher' => '/dashboard/teacher',
            'student' => '/dashboard/student',
            default   => '/',
        };
    }

}

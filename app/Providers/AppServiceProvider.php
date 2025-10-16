<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Auth\Events\Login as LoginEvent;
use App\Models\Login;

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
        \Event::listen(LoginEvent::class, function ($event) {
            Login::create([
                'user_id' => $event->user->id,
                'ip' => request()->ip(),
            ]);
        });
    }
}

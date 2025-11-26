<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Profile;
use App\Models\Contact;

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
        view()->composer('layouts.frontend', function($view) {
            $view->with('profiles', Profile::all());
            $view->with('contacts', Contact::all());
        });
    }

    public const HOME = '/dashboard';
}

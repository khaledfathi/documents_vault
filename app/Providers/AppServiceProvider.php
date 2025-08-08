<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
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
        // add custom view directory 
        View::addLocation(base_path('app/Features/Documents/Presentation/Views'));

        // add custom migration directory 
        // $this->loadMigrationsFrom( [
        //     database_path('migrations') , 
        //     base_path('app/Features/Documents/Infrastructure/Migrations') 
        // ]);

    }
}

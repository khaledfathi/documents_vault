<?php

namespace App\Features\Categories\Infrastrcture\Providers;

use App\Features\Categories\Application\Contracts\DestroyCategoryContract;
use App\Features\Categories\Application\Contracts\EditCategoryContract;
use App\Features\Categories\Application\Contracts\GetCategoryContract;
use App\Features\Categories\Application\Contracts\StoreCategoryContract;
use App\Features\Categories\Application\Contracts\UpdateCategoryContract;
use App\Features\Categories\Application\Usecases\DestroyCategoryUsecase;
use App\Features\Categories\Application\Usecases\EditCategoryUsecase;
use App\Features\Categories\Application\Usecases\GetCategoryUsecase;
use App\Features\Categories\Application\Usecases\StoreCategoryUsecase;
use App\Features\Categories\Application\Usecases\UpdateCategoryUsecase;
use Illuminate\Support\ServiceProvider;

class CategoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //Usecases 
        $this->app->bind(GetCategoryContract::class , GetCategoryUsecase::class);
        $this->app->bind(EditCategoryContract::class , EditCategoryUsecase::class);
        $this->app->bind(UpdateCategoryContract::class, UpdateCategoryUsecase::class);
        $this->app->bind(StoreCategoryContract::class , StoreCategoryUsecase::class);
        $this->app->bind(DestroyCategoryContract::class , DestroyCategoryUsecase::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}

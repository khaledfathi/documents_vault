<?php

namespace App\Shared\Infrastructure\Providers;

use App\Shared\Domain\Repositories\CategoryRepository;
use App\Shared\Domain\Repositories\DocumentRepository;
use App\Shared\Domain\Repositories\FileRepository;
use App\Shared\Domain\Storage\FileStorageContract;
use App\Shared\Infrastructure\Repositories\EloquentCategoryRepository;
use App\Shared\Infrastructure\Repositories\EloquentDocumentRepository;
use App\Shared\Infrastructure\Repositories\EloquentFileRepository;
use App\Shared\Infrastructure\Storage\LaravelStorage;
use Illuminate\Support\ServiceProvider;

class SharedServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //Shared Repositories
        $this->app->bind( DocumentRepository::class , EloquentDocumentRepository::class);
        $this->app->bind(FileRepository::class , EloquentFileRepository::class);
        $this->app->bind(CategoryRepository::class , EloquentCategoryRepository::class);

        //Shared Infrastructure
        $this->app->bind(FileStorageContract::class ,  LaravelStorage::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}

<?php

namespace App\Features\Documents\Infrastructure\Providers;

use App\Features\Documents\Application\Contracts\CreateDocumentContract;
use App\Features\Documents\Application\Contracts\DeleteDocumentContract;
use App\Features\Documents\Application\Contracts\EditDocumentContract;
use App\Features\Documents\Application\Contracts\FileStorageContract;
use App\Features\Documents\Application\Contracts\GetDocumentContract;
use App\Features\Documents\Application\Contracts\StoreDocumentContract;
use App\Features\Documents\Application\Contracts\UpdateDocumentContract;
use App\Features\Documents\Application\Usecases\DeleteDocumentUsecase;
use App\Features\Documents\Application\Usecases\GetDocumentUsecase;
use App\Features\Documents\Application\Usecases\StoreDocumentUsecase;
use App\Features\Documents\Application\Usecases\UpdateDocumentUsecase;
use App\Features\Documents\Domain\Repositories\CategoryRepository;
use App\Features\Documents\Domain\Repositories\DocumentRepository;
use App\Features\Documents\Domain\Repositories\FileRepository;
use App\Features\Documents\Infrastructure\Repositories\EloquentCategoryRepository;
use App\Features\Documents\Infrastructure\Repositories\EloquentDocumentRepository;
use App\Features\Documents\Infrastructure\Repositories\EloquentFileRepository;
use App\Features\Documents\Infrastructure\Storage\LaravelStorage;
use App\Features\Documents\Application\Usecases\CreateDocumentUsecase;
use App\Features\Documents\Application\Usecases\EditDocumentUsecase;
use Illuminate\Support\ServiceProvider;

class DocumentServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //Repositories
        $this->app->bind( DocumentRepository::class , EloquentDocumentRepository::class);
        $this->app->bind(FileRepository::class , EloquentFileRepository::class);
        $this->app->bind(CategoryRepository::class , EloquentCategoryRepository::class);

        //Usecases 
        $this->app->bind(GetDocumentContract::class , GetDocumentUsecase::class);
        $this->app->bind(StoreDocumentContract::class , StoreDocumentUsecase::class);
        $this->app->bind(DeleteDocumentContract::class , DeleteDocumentUsecase::class);
        $this->app->bind(CreateDocumentContract::class , CreateDocumentUsecase::class);
        $this->app->bind(EditDocumentContract::class , EditDocumentUsecase::class);
        $this->app->bind(UpdateDocumentContract::class , UpdateDocumentUsecase::class);

        //Infrastructure
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

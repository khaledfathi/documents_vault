<?php

namespace App\Features\Documents\Infrastrcture\Providers; 

use App\Features\Documents\Application\Contracts\CreateDocumentContract;
use App\Features\Documents\Application\Contracts\DeleteDocumentContract;
use App\Features\Documents\Application\Contracts\EditDocumentContract;
use App\Features\Documents\Application\Contracts\GetDocumentContract;
use App\Features\Documents\Application\Contracts\StoreDocumentContract;
use App\Features\Documents\Application\Contracts\UpdateDocumentContract;
use App\Features\Documents\Application\Usecases\CreateDocumentUsecase;
use App\Features\Documents\Application\Usecases\DeleteDocumentUsecase;
use App\Features\Documents\Application\Usecases\EditDocumentUsecase;
use App\Features\Documents\Application\Usecases\GetDocumentUsecase;
use App\Features\Documents\Application\Usecases\StoreDocumentUsecase;
use App\Features\Documents\Application\Usecases\UpdateDocumentUsecase;
use Illuminate\Support\ServiceProvider;

class DocumentServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //Usecases 
        $this->app->bind(GetDocumentContract::class , GetDocumentUsecase::class);
        $this->app->bind(StoreDocumentContract::class , StoreDocumentUsecase::class);
        $this->app->bind(DeleteDocumentContract::class , DeleteDocumentUsecase::class);
        $this->app->bind(CreateDocumentContract::class , CreateDocumentUsecase::class);
        $this->app->bind(EditDocumentContract::class , EditDocumentUsecase::class);
        $this->app->bind(UpdateDocumentContract::class , UpdateDocumentUsecase::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}

<?php
declare (strict_types= 1);

namespace App\Features\Documents\Application\Usecases;

use App\Features\Documents\Application\Contracts\CreateDocumentContract;
use App\Features\Documents\Application\Output\CreateDocumentOutput;
use App\Shared\Domain\Repositories\CategoryRepository;

final class CreateDocumentUsecase implements CreateDocumentContract{

    public function __construct(
        public CategoryRepository $categoryRepository
    ) {}
    public function prepeareCreateForm(CreateDocumentOutput $output):void{
        try{
            $output->ReceiveCategories( $this->categoryRepository->index());
        }catch (\Exception $e){
            $output->onFailure($e->getMessage());
        }
    }
}
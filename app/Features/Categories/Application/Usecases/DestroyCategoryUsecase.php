<?php
declare (strict_types= 1);
namespace App\Features\Categories\Application\Usecases;

use App\Features\Categories\Application\Contracts\DestroyCategoryContract;
use App\Features\Categories\Application\Outputs\DestroyCategoryOutput;
use App\Shared\Domain\Constants\Constants;
use App\Shared\Domain\Repositories\CategoryRepository;
use App\Shared\Domain\Repositories\DocumentRepository;

final class DestroyCategoryUsecase implements DestroyCategoryContract { 
    public function __construct(
        private CategoryRepository $categoryRepository,
        private DocumentRepository $documentRepository
    ) { }

    public function delete (int $categoryId , DestroyCategoryOutput $output):void {
        try {
            if($categoryId == Constants::DEFAULT_CATEGORY_ID){
                $output->onTryingDeleteDefaultCategory('Can not delete default category.');
            }else {
                //shift all releated data from deleted category to default category
                $this->documentRepository->moveDocumentsFromCategoryToDefault($categoryId , Constants::DEFAULT_CATEGORY_ID);
                //delete | output
                $output->onSuccess($this->categoryRepository->destroy($categoryId));
            }
        } catch (\Exception $e) {
           $output->onFailure($e->getMessage()) ;
        }
    }
}

        // shift all documents to default category before deleting 
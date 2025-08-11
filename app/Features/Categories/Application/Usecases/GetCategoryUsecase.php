<?php
declare (strict_types= 1);
namespace App\Features\Categories\Application\Usecases;

use App\Features\Categories\Application\Contracts\GetCategoryContract;
use App\Features\Categories\Application\Outputs\GetAllCategoryOutput;
use App\Shared\Domain\Repositories\CategoryRepository;

final class GetCategoryUsecase implements GetCategoryContract {

    public function __construct(
        private CategoryRepository $categoryRepository
    ) {}

    public function all (GetAllCategoryOutput $output)  :void{
        try {
            $output->onSuccess($this->categoryRepository->index());
        }catch (\Exception $e){
            $output->onFailure($e->getMessage());
        }
    } 
}
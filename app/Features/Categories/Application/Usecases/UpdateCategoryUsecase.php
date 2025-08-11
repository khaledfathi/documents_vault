<?php
declare (strict_types= 1);
namespace App\Features\Categories\Application\Usecases;

use App\Features\Categories\Application\Contracts\UpdateCategoryContract;
use App\Features\Categories\Application\Outputs\UpdateCategoryOutput;
use App\Shared\Domain\Entities\CategoryEntity;
use App\Shared\Domain\Repositories\CategoryRepository;

final class UpdateCategoryUsecase implements UpdateCategoryContract {
    public function __construct( 
        private CategoryRepository $categoryRepository 
    ) {}
    public function update(CategoryEntity $category, UpdateCategoryOutput $output): void{
        try{
            $output->onSucess($this->categoryRepository->update($category));
            
        }catch(\Exception $e){
            $output->onFailure($e->getMessage());
        }
    }
}
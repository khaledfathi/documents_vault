<?php

declare(strict_types=1);

namespace App\Features\Categories\Application\Usecases;

use App\Features\Categories\Application\Contracts\StoreCategoryContract;
use App\Features\Categories\Application\Outputs\StoreCategoryOutput;
use App\Shared\Domain\Entities\CategoryEntity;
use App\Shared\Domain\Repositories\CategoryRepository;

final class StoreCategoryUsecase implements StoreCategoryContract
{
    public function __construct(
        private CategoryRepository $categoryRepository
    ) {}

    public function store(CategoryEntity $category, StoreCategoryOutput $output):void 
    {
        try {
            $output->onSuccess($this->categoryRepository->store($category));
        } catch (\Exception $e) {
            $output->onFailure($e->getMessage());
        }
    }
}

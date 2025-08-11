<?php
declare (strict_types= 1);

namespace App\Features\Categories\Application\Contracts;

use App\Features\Categories\Application\Outputs\UpdateCategoryOutput;
use App\Shared\Domain\Entities\CategoryEntity;

interface UpdateCategoryContract  { 
    public function update(CategoryEntity $category, UpdateCategoryOutput $output): void;
}
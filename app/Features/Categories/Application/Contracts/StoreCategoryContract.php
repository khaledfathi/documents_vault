<?php
declare(strict_types= 1);
 
namespace App\Features\Categories\Application\Contracts;

use App\Features\Categories\Application\Outputs\StoreCategoryOutput;
use App\Shared\Domain\Entities\CategoryEntity;

interface StoreCategoryContract {
    public function store(CategoryEntity $category, StoreCategoryOutput $output):void ;
}
<?php
declare (strict_types= 1);
namespace App\Features\Categories\Application\Outputs;

use App\Shared\Domain\Entities\CategoryEntity;

interface GetAllCategoryOutput{
    /**
     * 
     * @param array $categories
     * @return array<CategoryEntity>
     */
    public function onSuccess(array $categories):void ;
    public function onFailure(string $error):void ;
}
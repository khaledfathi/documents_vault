<?php
declare (strict_types= 1);
namespace App\Features\Categories\Application\Outputs;

use App\Shared\Domain\Entities\CategoryEntity;

interface StoreCategoryOutput {
    public function onSuccess(CategoryEntity $categories):void ;
    public function onFailure(string $error):void ;
}
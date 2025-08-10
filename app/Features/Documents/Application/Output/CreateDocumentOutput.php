<?php 
declare(strict_types= 1);
namespace App\Features\Documents\Application\Output;

use App\Features\Documents\Domain\Entities\CategoryEntity;

interface CreateDocumentOutput{
    /**
     * 
     * @param array<CategoryEntity> $output
     * @return void
     */
    public function ReceiveCategories(array $categories):void;
    public function onFailure(string $error):void;
}
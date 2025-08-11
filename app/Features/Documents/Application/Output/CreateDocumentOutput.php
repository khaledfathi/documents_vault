<?php 
declare(strict_types= 1);
namespace App\Features\Documents\Application\Output;

use App\Shared\Domain\Entities\DocumentEntity;

interface CreateDocumentOutput{
    /**
     * 
     * @param array<DocumentEntity> $output
     * @return void
     */
    public function ReceiveCategories(array $categories):void;
    public function onFailure(string $error):void;
}
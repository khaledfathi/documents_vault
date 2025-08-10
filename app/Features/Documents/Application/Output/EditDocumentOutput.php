<?php
declare (strict_types=1) ;

namespace App\Features\Documents\Application\Output;

use App\Features\Documents\Domain\Entities\CategoryEntity;
use App\Features\Documents\Domain\Entities\DocumentEntity;

interface EditDocumentOutput {
    /**
     *
     * @param DocumentEntity $documents
     * @param array<CategoryEntity> $categories
     * @return void
     */
    public function onSuccess (DocumentEntity $documents, array $files , array $categories):void ;
    public function onFailure(string $error):void;
}
<?php
declare(strict_types=1);

namespace App\Features\Documents\Application\Output;

use App\Shared\Domain\Entities\DocumentEntity;

interface GetAllDocumentOutput {
    /**
     * 
     * @param array<DocumentEntity> $documents
     * @return void
     */
    public function onSuccess(array $documents): void;
    public function onFailure(string $error): void;
}
<?php
declare(strict_types= 1);

namespace App\Features\Documents\Application\Contracts;

use App\Features\Documents\Application\DTOs\DocumentFileDTO;
use App\Features\Documents\Application\Output\UpdateDocumentOutput;
use App\Shared\Domain\Entities\DocumentEntity;

interface UpdateDocumentContract {


    /**
     * Summary of update
     * @param DocumentEntity $data
     * @param ?array $fileToDeleteIds
     * @param ?array<DocumentFileDTO> $newFiles
     * @param UpdateDocumentOutput $output
     * @return void
     */
    public function update(DocumentEntity $documnet, ?array $filesToDeleteIds, ?array $newFiles,   UpdateDocumentOutput $output):void;
}

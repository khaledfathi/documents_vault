<?php
declare(strict_types= 1);

namespace App\Features\Documents\Application\Contracts;

use App\Features\Documents\Application\Output\UpdateDocumentOutput;
use App\Features\Documents\Domain\Entities\DocumentEntity;

interface UpdateDocumentContract {


    /**
     * Summary of update
     * @param \App\Features\Documents\Domain\Entities\DocumentEntity $data
     * @param ?array $fileToDelete
     * @param ?array<\App\Features\Documents\Application\DTOs\DocumentFileDTO> $newFiles
     * @param \App\Features\Documents\Application\Output\UpdateDocumentOutput $output
     * @return void
     */
    public function update(DocumentEntity $documnet, ?array $filesToDeleteIds, ?array $newFiles,   UpdateDocumentOutput $output):void;
}

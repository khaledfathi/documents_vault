<?php
declare(strict_types= 1);

namespace App\Features\Documents\Application\Output;

use App\Shared\Domain\Entities\DocumentEntity;

interface StoreDocumentOutput {
    public function onSuccess(DocumentEntity $document): void;
    public function onFailure(string $error): void;
}
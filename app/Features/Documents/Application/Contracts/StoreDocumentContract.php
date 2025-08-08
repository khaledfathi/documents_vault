<?php
declare(strict_types= 1);

namespace App\Features\Documents\Application\Contracts;

use App\Features\Documents\Application\DTOs\DocumentsStoreInputDTO;
use App\Features\Documents\Application\Output\StoreDocumentOutput;

interface StoreDocumentContract {
    public function store( DocumentsStoreInputDTO $documentDTO , StoreDocumentOutput $output):void;
}
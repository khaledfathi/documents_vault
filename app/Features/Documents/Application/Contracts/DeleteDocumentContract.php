<?php
declare( strict_types= 1);

namespace App\Features\Documents\Application\Contracts;

use App\Features\Documents\Application\Output\DeleteDocumentOutput;

interface DeleteDocumentContract {
    public function delete(int $documentId , DeleteDocumentOutput $output):void;
}

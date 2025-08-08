<?php
declare (strict_types= 1);
namespace App\Features\Documents\Application\Output;

use App\Features\Documents\Domain\Entities\DocumentEntity;

interface ShowDocumentOutput {
    public function onSuccess(DocumentEntity $document):void; 
    public function onFailure(string $error):void; 
}
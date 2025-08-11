<?php
declare (strict_types= 1);

namespace App\Features\Documents\Application\Output; 

interface UpdateDocumentOutput {
    public function onSuccess(int $affectedCount):void;
    public function onFailure(string $error):void;
}
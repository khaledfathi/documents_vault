<?php
declare (strict_types=1) ;

namespace App\Features\Documents\Application\Contracts;

use App\Features\Documents\Application\Output\EditDocumentOutput;

interface EditDocumentContract {
    public function prepareEditForm (int $documentId , EditDocumentOutput $output):void ;
    
    
}
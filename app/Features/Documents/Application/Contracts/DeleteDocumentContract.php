<?php
declare( strict_types= 1);

namespace App\Features\Documents\Application\Contracts;

use App\Features\Documents\Application\Output\DeleteDocumentOutput;

interface DeleteDocumentContract {
    public function deleteAll():void;
    public function delete(int $id , DeleteDocumentOutput $output):void;
}

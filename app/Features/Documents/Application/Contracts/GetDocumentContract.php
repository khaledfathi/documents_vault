<?php
declare(strict_types=1);

namespace App\Features\Documents\Application\Contracts;

use App\Features\Documents\Application\Output\GetAllDocumentOutput;
use App\Features\Documents\Application\Output\ShowDocumentOutput;

interface GetDocumentContract  {
    public function all( GetAllDocumentOutput $output):void;
    public function show( int $id , ShowDocumentOutput $output):void;
}
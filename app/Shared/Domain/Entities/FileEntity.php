<?php
declare(strict_types=1);

namespace App\Shared\Domain\Entities; 

class FileEntity {
    function __construct(
        public ?int $id = null,
        public ?int $documentId = null,
        public ?string $file = null
    ){ }
}
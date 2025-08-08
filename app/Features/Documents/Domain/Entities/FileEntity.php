<?php
declare(strict_types=1);

namespace App\Features\Documents\Domain\Entities;

class FileEntity {
    function __construct(
        public ?int $id = null,
        public ?int $documentId = null,
        public ?string $file = null
    ){ }
}
<?php

declare(strict_types=1);

namespace App\Shared\Domain\Entities; 

class DocumentEntity
{
    /**
     * 
     * @param ?int $id
     * @param ?int $categoryId
     * @param  ?string $categoryName
     * @param  ?string $name
     * @param  ?string $description
     * @param  ?string $filesCount
     * @param  ?array<FileEntity> $files
     */
    public function __construct(
        public ?int $id = null,
        public ?int $categoryId = null,
        public ?string $categoryName = null,
        public ?string $name = null,
        public ?string $description = null,
        public ?int $filesCount = null,
        public ?array $files = null,
    ) {}

}

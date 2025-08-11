<?php
declare (strict_types=1);

namespace App\Features\Documents\Application\DTOs; 

class  DocumentsStoreInputDTO {
    /**
     * Summary of __construct
     * @param string $name
     * @param string $categoryId
     * @param string $description
     * @param array<DocumentFileDTO> $files
     */
    public function __construct(
        public string $name,
        public string $categoryId,
        public string $description,
        public array $files

    ){ }
}
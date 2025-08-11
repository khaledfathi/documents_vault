<?php

namespace App\Features\Documents\Application\DTOs; 

class DocumentFileDTO {
    public function __construct(
        public string $fileName,
        public string $fileContent,
        public string $mimeType,
    ){ }
}
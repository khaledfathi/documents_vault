<?php
declare (strict_types= 1);

namespace App\Features\Documents\Domain\Entities; 

class CategoryEntity {
    public  function __construct(
        public ?int $id,
        public ?string $name,
        public ?string $description,
    ){}
}
<?php
declare (strict_types= 1);

namespace App\Features\Categories\Application\Outputs;


interface UpdateCategoryOutput {
    public function onSucess(int $affectedCount): void;
    public function onFailure(string $error): void;
}

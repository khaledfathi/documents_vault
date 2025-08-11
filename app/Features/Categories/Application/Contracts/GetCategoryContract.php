<?php
declare(strict_types= 1);

namespace App\Features\Categories\Application\Contracts;

use App\Features\Categories\Application\Outputs\GetAllCategoryOutput;

interface GetCategoryContract {
    public function all (GetAllCategoryOutput $output);
}

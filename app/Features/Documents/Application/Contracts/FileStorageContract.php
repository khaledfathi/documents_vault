<?php
declare(strict_types = 1);

namespace App\Features\Documents\Application\Contracts;

interface FileStorageContract {
    public function save(string $path , string $fileName, string $content ,): bool;
    public function delete(string $path , string $fileName): bool;
}
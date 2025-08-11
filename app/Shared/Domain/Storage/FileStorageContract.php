<?php
declare(strict_types = 1);

namespace App\Shared\Domain\Storage; 

interface FileStorageContract {
    public function save(string $path , string $fileName, string $content ,): bool;
    public function delete(string $path , string $fileName): bool;
}
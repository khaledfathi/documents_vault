<?php
declare(strict_types= 1);

namespace App\Shared\Infrastructure\Storage;

use App\Shared\Domain\Storage\FileStorageContract;
use Illuminate\Support\Facades\Storage;

class LaravelStorage implements FileStorageContract {

    public function save(string $path , string $fileName, string $content ):bool{
        return Storage::disk('public')->put($path.DIRECTORY_SEPARATOR.$fileName , $content);
    }
    public function delete(string $path , string $fileName): bool{
        return Storage::disk('public')->delete($path.DIRECTORY_SEPARATOR.$fileName );
    }
}
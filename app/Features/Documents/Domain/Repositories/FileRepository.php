<?php
declare(strict_types= 1);

namespace App\Features\Documents\Domain\Repositories;

use App\Features\Documents\Domain\Entities\FileEntity;

interface  FileRepository{

    public function show (int $fileId):FileEntity;
    public function store (FileEntity $file): FileEntity;

    /**
     *
     * @param int $documnetId
     * @return array<FileEntity>
     */
    public function getReleatedToDocumnet(int $fileId):array;
    public function destroy ($fileId):int;
}
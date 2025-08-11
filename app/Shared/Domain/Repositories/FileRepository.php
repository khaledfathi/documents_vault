<?php
declare(strict_types= 1);

namespace App\Shared\Domain\Repositories;

use App\Shared\Domain\Entities\FileEntity;

interface  FileRepository{

    public function show (int $id):FileEntity;
    public function store (FileEntity $file): FileEntity;

    /**
     *
     * @param int $documnetId
     * @return array<FileEntity> 
     */
    public function getReleatedToDocumnet(int $documentId):array;
    public function destroy ($fileId):int;
}
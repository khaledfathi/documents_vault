<?php
declare(strict_types= 1);

namespace App\Features\Documents\Domain\Repositories;

use App\Features\Documents\Domain\Entities\FileEntity;

interface  FileRepository{

    /**
     *
     * @param int $documnetId
     * @return array<FileEntity>
     */
    public function getReleatedToDocumnet(int $documnetId):array;
}
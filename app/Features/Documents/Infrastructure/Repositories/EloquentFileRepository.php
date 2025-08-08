<?php
declare(strict_types=1);

namespace App\Features\Documents\Infrastructure\Repositories;

use App\Features\Documents\Domain\Entities\FileEntity;
use App\Features\Documents\Domain\Repositories\FileRepository;
use App\Features\Documents\Infrastructure\Models\File;

class EloquentFileRepository implements FileRepository {

    public function show(int $id):FileEntity{
        return File::findOrFail($id);
    }
    
    /**
     *
     * @param int $documnetId
     * @return array<FileEntity>
     */
    public function getReleatedToDocumnet(int $documnetId):array{
        $filesRecords = File::where('document_id', $documnetId)->get() ?? [];
        //DTO
        $filesArray = []; 
        foreach($filesRecords as $file){
            $filesArray[] = new FileEntity(
                $file->id,
                $file->documnet_id,
                $file->file,
            );
        }
        return $filesArray;
    }
}
<?php
declare(strict_types=1);

namespace App\Features\Documents\Infrastructure\Repositories;

use App\Features\Documents\Domain\Entities\FileEntity;
use App\Features\Documents\Domain\Repositories\FileRepository;
use App\Features\Documents\Infrastructure\Models\File;

class EloquentFileRepository implements FileRepository {

    public function show(int $id):FileEntity{
        $file = File::findOrFail($id);
        return new FileEntity(
            $file->id,
            $file->documnet_id,
            $file->file,
        );
    }
    public function store (FileEntity $file): FileEntity{
        $record = File::create([
            "document_id"=> $file->documentId,
            "file"=> $file->file,
        ]);
        $file->id = $record->id;
        return $file;
    }
    
    /**
     *
     * @param int $documnetId
     * @return array<FileEntity>
     */
    public function getReleatedToDocumnet(int $fileId):array{
        $filesRecords = File::where('document_id', $fileId)->get() ?? [];
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
    public function destroy ($fileId):int{
        return File::where('id', $fileId)->delete() ?? 0;
    }
}
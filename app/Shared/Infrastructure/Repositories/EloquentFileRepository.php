<?php
declare(strict_types=1);

namespace App\Shared\Infrastructure\Repositories; 

use App\Shared\Domain\Entities\FileEntity;
use App\Shared\Domain\Repositories\FileRepository;
use App\Shared\Infrastructure\Models\File;

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
    public function getReleatedToDocumnet(int $documentId):array{
        $filesRecords = File::where('document_id', $documentId)->get() ?? [];
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
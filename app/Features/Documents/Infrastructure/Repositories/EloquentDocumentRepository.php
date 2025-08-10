<?php

declare(strict_types=1);

namespace App\Features\Documents\Infrastructure\Repositories;

use App\Features\Documents\Domain\Entities\DocumentEntity;
use App\Features\Documents\Domain\Repositories\DocumentRepository;
use App\Features\Documents\Infrastructure\Models\Document;
use App\Features\Documents\Infrastructure\Models\File;

class EloquentDocumentRepository implements DocumentRepository
{

    public function index(): array
    {
        $documents = Document::withCategoryName()->get();
        $result = [];
        //DTO
        foreach ($documents as $document) {
            $result[] = new DocumentEntity(
                $document->id,
                $document->category_id,
                $document->category_name,
                $document->name,
                $document->description,
                $document->files_count
            );
        }
        return $result;
    }

    /**
     *
     * @param DocumentEntity $document
     * @param array<string> $file
     * @return DocumentEntity
     */
    public function store(DocumentEntity $document, array $fileNames): DocumentEntity
    {
        //store document
        $record = Document::create([
            "category_id" => $document->categoryId,
            "name" => $document->name,
            "description" => $document->description,
        ]);
        //store files names releated to this record to file table
        foreach ($fileNames as $fileName) {
            File::create([
                'file' => $fileName,
                'document_id' => $record->id,
            ]);
        }
        $document->id = $record->id;
        return $document;
    }

    public function update (DocumentEntity $document):int{
        return Document::where('id', $document->id)->update([
            'name'=>$document->name,
            'category_id' => $document->categoryId,
            'description' => $document->description,
        ]) ?? 0;
    }

    public function show(int  $id): DocumentEntity
    {
        $document = Document::where('documents.id', $id)->withCategoryName()?->first();

        $files =[]; 
        foreach ($document->files as $file) {  
            $files[] = $file->file;
        }

        return new DocumentEntity(
            $document->id,
            $document->category_id,
            $document->category_name,
            $document->name,
            $document->description,
            $document->files_count,
            $files
        );
    }

    public function destroy(int  $id):int{
        return Document::where('id', $id )->delete() ?? 0 ;
    }

}

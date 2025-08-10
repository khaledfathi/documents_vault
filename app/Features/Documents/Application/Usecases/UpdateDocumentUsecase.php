<?php

declare(strict_types=1);

namespace App\Features\Documents\Application\Usecases;

use App\Features\Documents\Application\Contracts\FileStorageContract;
use App\Features\Documents\Application\Contracts\UpdateDocumentContract;
use App\Features\Documents\Application\Output\UpdateDocumentOutput;
use App\Features\Documents\Domain\Entities\DocumentEntity;
use App\Features\Documents\Domain\Entities\FileEntity;
use App\Features\Documents\Domain\Repositories\DocumentRepository;
use App\Features\Documents\Domain\Repositories\FileRepository;

class UpdateDocumentUsecase implements UpdateDocumentContract
{
    public function __construct(
        private DocumentRepository $documentRepository,
        private FileRepository $fileRepository,
        private FileStorageContract $fileStorage
    ) {}

    /**
     * Summary of update
     * @param \App\Features\Documents\Domain\Entities\DocumentEntity $data
     * @param ?array $fileToDelete
     * @param ?array<\App\Features\Documents\Application\DTOs\DocumentFileDTO> $newFiles
     * @param \App\Features\Documents\Application\Output\UpdateDocumentOutput $output
     * @return void
     */
    public function update(DocumentEntity $document, ?array $filesToDeleteIds, ?array $newFiles,   UpdateDocumentOutput $output):void{
        try {

            foreach ($filesToDeleteIds ?? [] as $fileId) {
                $file = $this->fileRepository->show((int)$fileId);
                // delete files 
                if ($file) {
                    $this->fileStorage->delete('documnets' , $file->file);
                    $this->fileRepository->destroy($fileId);
                }
            }

            // handle new files
            foreach ($newFiles ?? [] as $file) {
                $fileName = time() . "_" . $file->fileName;
                $this->fileStorage->save("documents", $fileName, $file->fileContent);
                $this->fileRepository->store( 
                    new FileEntity( 
                        documentId: $document->id,
                        file: $fileName,
                    )
                );
            }
            // //update document

            $output->onSuccess(
                $this->documentRepository->update($document)
            );
        } catch (\Exception $e) {
            dd($e->getMessage());
            $output->onFailure($e->getMessage());
        }
    }
}
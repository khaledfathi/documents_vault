<?php

declare(strict_types=1);

namespace App\Features\Documents\Application\Usecases;

use App\Features\Documents\Application\Contracts\UpdateDocumentContract;
use App\Features\Documents\Application\DTOs\DocumentFileDTO;
use App\Features\Documents\Application\Output\UpdateDocumentOutput;
use App\Shared\Domain\Entities\DocumentEntity;
use App\Shared\Domain\Entities\FileEntity;
use App\Shared\Domain\Repositories\DocumentRepository;
use App\Shared\Domain\Repositories\FileRepository;
use App\Shared\Domain\Storage\FileStorageContract;

final class UpdateDocumentUsecase implements UpdateDocumentContract
{
    public function __construct(
        private DocumentRepository $documentRepository,
        private FileRepository $fileRepository,
        private FileStorageContract $fileStorage
    ) {}

    /**
     * Summary of update
     * @param DocumentEntity $data
     * @param ?array $fileToDelete
     * @param ?array<DocumentFileDTO> $newFiles
     * @param UpdateDocumentOutput $output 
     * @return void
     */
    public function update(DocumentEntity $document, ?array $filesToDeleteIds, ?array $newFiles,   UpdateDocumentOutput $output):void{
        try {

            //handle delete old files 
            $this->handleDeleteOldFile($filesToDeleteIds);
            //handle store new files  
            $this->handelStoreNewFiles($document->id, $newFiles);
            //update document
            $output->onSuccess( $this->documentRepository->update($document));
        } catch (\Exception $e) {
            dd($e->getMessage());
            $output->onFailure($e->getMessage());
        }
    }

    /**
     *
     * @param array<string> $filesToDeleteIds
     * @return void
     */
    private function handleDeleteOldFile($filesToDeleteIds) {
            foreach ($filesToDeleteIds ?? [] as $fileId) {
                $file = $this->fileRepository->show((int)$fileId);
                // delete files 
                if ($file) {
                    $this->fileStorage->delete('documnets' , $file->file);
                    $this->fileRepository->destroy($fileId);
                }
            }
    }
    /**
     * @param int $documentId
     * @param array<DocumentFileDTO> $newFiles
     * @return void
     */
    private function handelStoreNewFiles(int $documentId , array $newFiles){
            foreach ($newFiles ?? [] as $file) {
                $fileName = time() . "_" . $file->fileName;
                $this->fileStorage->save("documents", $fileName, $file->fileContent);
                $this->fileRepository->store( 
                    new FileEntity( 
                        documentId: $documentId ,
                        file: $fileName,
                    )
                );
            }
    }
}
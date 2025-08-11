<?php
declare (strict_types= 1);

namespace App\Features\Documents\Application\Usecases;

use App\Features\Documents\Application\Contracts\DeleteDocumentContract;
use App\Features\Documents\Application\Output\DeleteDocumentOutput;
use App\Shared\Domain\Repositories\DocumentRepository;
use App\Shared\Domain\Repositories\FileRepository;
use App\Shared\Domain\Storage\FileStorageContract;

final class DeleteDocumentUsecase implements DeleteDocumentContract{
    public function __construct(
        public DocumentRepository $documentRepository,
        public FileRepository $fileRepository ,
        public FileStorageContract $fileStorage
    ) {}

    public function delete(int $documentId , DeleteDocumentOutput $output):void{
        try{
            //delete file releated from storage
            $this->deleteReleatedFiles($documentId );
            //delete documents | output
            $output->onSuccess($this->documentRepository->destroy($documentId));

        }catch (\Exception $e){
            $output->onFailure($e->getMessage());
        }
    }

    /**
     * Delete files releated to the document 
     * @return void
     */
    private function deleteReleatedFiles (int $documentId) {
            $files = $this->fileRepository->getReleatedToDocumnet($documentId);
            foreach ($files as $file){
                $this->fileStorage->delete('documents', $file->file);
            }
    }
}
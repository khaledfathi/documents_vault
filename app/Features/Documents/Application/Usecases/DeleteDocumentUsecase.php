<?php
declare (strict_types= 1);

namespace App\Features\Documents\Application\Usecases;

use App\Features\Documents\Application\Contracts\DeleteDocumentContract;
use App\Features\Documents\Application\Contracts\FileStorageContract;
use App\Features\Documents\Application\Output\DeleteDocumentOutput;
use App\Features\Documents\Domain\Repositories\DocumentRepository;
use App\Features\Documents\Domain\Repositories\FileRepository;

class DeleteDocumentUsecase implements DeleteDocumentContract{
    public function __construct(
        public DocumentRepository $documentRepository,
        public FileRepository $fileRepository ,
        public FileStorageContract $fileStorage
    ) {}
    public function deleteAll():void{

    }
    public function delete(int $id , DeleteDocumentOutput $output):void{
        try{
            //delete file releated from storage
            $files = $this->fileRepository->getReleatedToDocumnet($id);
            foreach ($files as $file){
                $this->fileStorage->delete('documents', $file->file);
            }

            //delete documents
            $this->documentRepository->destroy($id);

        }catch (\Exception $e){
            $output->onFailure($e->getMessage());
        }
    }
}
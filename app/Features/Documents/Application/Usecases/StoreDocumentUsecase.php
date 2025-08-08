<?php
declare(strict_types= 1);

namespace App\Features\Documents\Application\Usecases;

use App\Features\Documents\Application\Contracts\FileStorageContract;
use App\Features\Documents\Application\Contracts\StoreDocumentContract;
use App\Features\Documents\Application\DTOs\DocumentsStoreInputDTO;
use App\Features\Documents\Application\Output\StoreDocumentOutput;
use App\Features\Documents\Domain\Entities\DocumentEntity;
use App\Features\Documents\Domain\Repositories\DocumentRepository;

class StoreDocumentUsecase  implements StoreDocumentContract {

    public function __construct(
        private DocumentRepository $documentRepository,
        private FileStorageContract $fileStorage
    ){}

    public function store( DocumentsStoreInputDTO $documentDTO , StoreDocumentOutput $output):void{
        //generate document object 
        $document = new DocumentEntity(
            categoryId: (int)$documentDTO->categoryId,
            name: $documentDTO->name,
            description : $documentDTO->description
        );
        // handle files if exists 
        $files = $documentDTO->files; 
        $fileNamesList = []; 
        if (count($files)) {
            foreach ($files as $file) {
                $fileName = time() . "_" . $file->fileName;
                $fileNamesList[] =$fileName; 
                $this->fileStorage->save('documents',  $fileName , $file->fileContent);
            }
        }

        //store
        try {
            $output->onSucess($this->documentRepository->store($document, $fileNamesList));

        }catch (\Exception $e){
            $output->onFailure($e->getMessage());
        }

    }
}
    
<?php

declare(strict_types=1);

namespace App\Features\Documents\Application\Usecases;

use App\Features\Documents\Application\Contracts\StoreDocumentContract;
use App\Features\Documents\Application\DTOs\DocumentFileDTO;
use App\Features\Documents\Application\DTOs\DocumentsStoreInputDTO;
use App\Features\Documents\Application\Output\StoreDocumentOutput;
use App\Shared\Domain\Entities\DocumentEntity;
use App\Shared\Domain\Repositories\DocumentRepository;
use App\Shared\Domain\Storage\FileStorageContract;

final class StoreDocumentUsecase  implements StoreDocumentContract
{

    public function __construct(
        private DocumentRepository $documentRepository,
        private FileStorageContract $fileStorage
    ) {}

    public function store(DocumentsStoreInputDTO $documentDTO, StoreDocumentOutput $output): void
    {
        $document= $this->generateDocumentObject($documentDTO);
        $fileNamesList =  $this->handleFiles($documentDTO->files);

        // store|output
        try {
            $output->onSuccess($this->documentRepository->store($document, $fileNamesList));

        } catch (\Exception $e) {
            $output->onFailure($e->getMessage());
        }
    }

    private function generateDocumentObject(DocumentsStoreInputDTO $documentDTO,): DocumentEntity
    {
        return new DocumentEntity(
            categoryId: (int)$documentDTO->categoryId,
            name: $documentDTO->name,
            description: $documentDTO->description
        );
    }

    /**
     *
     * @param array<DocumentFileDTO> $files
     * @return array<string> files names list 
     */
    private function handleFiles (array $files):array{
        $fileNamesList = [];
        if (count($files)) {
            foreach ($files as $file) {
                $fileName = time() . "_" . $file->fileName;
                $fileNamesList[] = $fileName;
                $this->fileStorage->save('documents',  $fileName, $file->fileContent);
            }
        }
        return $fileNamesList;
    }
}

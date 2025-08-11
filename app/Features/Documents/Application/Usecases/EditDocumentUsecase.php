<?php

declare(strict_types=1);

namespace App\Features\Documents\Application\Usecases;

use App\Features\Documents\Application\Contracts\EditDocumentContract;
use App\Features\Documents\Application\Output\EditDocumentOutput;
use App\Shared\Domain\Repositories\CategoryRepository;
use App\Shared\Domain\Repositories\DocumentRepository;
use App\Shared\Domain\Repositories\FileRepository;

final class EditDocumentUsecase implements EditDocumentContract
{
    public function __construct(
        private DocumentRepository $documentRepository,
        private CategoryRepository $categoryRepository,
        private FileRepository $fileRepository
    ) {}
    public function prepareEditForm(int $documentId, EditDocumentOutput $output): void
    {
        try {
            $document = $this->documentRepository->show($documentId);
            $files = $this->fileRepository->getReleatedToDocumnet($documentId);
            $categories = $this->categoryRepository->index();
            $output->onSuccess($document, $files , $categories);
        } catch (\Exception $e) {
            $output->onFailure($e->getMessage());
        }
    }
}

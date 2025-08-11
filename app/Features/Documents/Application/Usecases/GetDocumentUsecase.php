<?php
declare(strict_types=1);

namespace App\Features\Documents\Application\Usecases;

use App\Features\Documents\Application\Contracts\GetDocumentContract;
use App\Features\Documents\Application\Output\GetAllDocumentOutput;
use App\Features\Documents\Application\Output\ShowDocumentOutput;
use App\Shared\Domain\Repositories\DocumentRepository;

final class GetDocumentUsecase implements GetDocumentContract {

    public function __construct(
        private DocumentRepository $documentRepository,
    ){}
    public function all( GetAllDocumentOutput $output):void{
        try {
            $output->onSuccess($this->documentRepository->index());
        }catch (\Exception $e) {
            $output->onFailure($e->getMessage());
        }
    }

    public function show( int $id , ShowDocumentOutput $output):void{
        try {
            $output->onSuccess($this->documentRepository->show($id));
        }catch (\Exception $e) {
            $output->onFailure($e->getMessage());
        }
        
    }

}
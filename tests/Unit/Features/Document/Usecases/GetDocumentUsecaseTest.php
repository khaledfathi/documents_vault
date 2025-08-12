<?php

declare(strict_types=1);

namespace Tests\Unit;

use App\Features\Documents\Application\Output\GetAllDocumentOutput;
use App\Features\Documents\Application\Usecases\GetDocumentUsecase;
use App\Shared\Domain\Repositories\DocumentRepository;
use Mockery;
use Tests\TestCase;

class GetDocumentUsecaseTest extends TestCase
{
    public function test_get_all_document_on_success ():void{
        //Arrange
        $mockGetDocumentRepo = Mockery::mock(DocumentRepository::class);
        $mockGetAllDocumentOutput = Mockery::mock(GetAllDocumentOutput::class);

        $mockGetDocumentRepo->shouldReceive('index')
            ->once()
            ->andReturn([]);

        //Assert
        $mockGetAllDocumentOutput->shouldReceive('onSuccess')
        ->once()
        ->withArgs(function ($receivedDocuments){
            $this->assertEquals([], $receivedDocuments);
            return true;
        });

        //Act
        $usecase = new GetDocumentUsecase($mockGetDocumentRepo);
        $usecase->all($mockGetAllDocumentOutput);
    }
}

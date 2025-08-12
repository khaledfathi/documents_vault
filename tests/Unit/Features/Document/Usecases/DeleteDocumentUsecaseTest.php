<?php

namespace Tests\Unit\Features\Document\Usecases;

use App\Features\Documents\Application\Output\DeleteDocumentOutput;
use App\Features\Documents\Application\Usecases\DeleteDocumentUsecase;
use App\Shared\Domain\Repositories\DocumentRepository;
use App\Shared\Domain\Repositories\FileRepository;
use App\Shared\Domain\Storage\FileStorageContract;
use Mockery;
use PHPUnit\Framework\TestCase;

class DeleteDocumentUsecaseTest extends TestCase
{
    public function test_delete_document_on_success(): void
    {
        // Arrange
        $mockDocumentRepo = Mockery::mock(DocumentRepository::class);
        $mockFileRepo = Mockery::mock(FileRepository::class);
        $fileStorage = Mockery::mock(FileStorageContract::class);
        $mockDeleteDocumentOutput = Mockery::mock(DeleteDocumentOutput::class);

        $affectedCount = 1;

        $mockDocumentRepo->shouldReceive('destroy')
            ->once()
            ->with(1)
            ->andReturn($affectedCount);

        $mockFileRepo->shouldReceive('getReleatedToDocumnet')
            ->once()
            ->with(1)
            ->andReturn([]);

        // Assert 
        $mockDeleteDocumentOutput->shouldReceive('onSuccess')
            ->once()
            ->withArgs( function ($receivedAffectedCount) use ($affectedCount) {
                $this->assertEquals($affectedCount, $receivedAffectedCount);
                return true; 
            });

        // Act
        $usecase = new DeleteDocumentUsecase(
            $mockDocumentRepo,
            $mockFileRepo,
            $fileStorage
        );

        $usecase->delete(1, $mockDeleteDocumentOutput);
    }

    public function test_delete_document_on_failure(): void{

        // Arrange
        $mockDocumentRepo = Mockery::mock(DocumentRepository::class);
        $mockFileRepo = Mockery::mock(FileRepository::class);
        $fileStorage = Mockery::mock(FileStorageContract::class);
        $mockDeleteDocumentOutput = Mockery::mock(DeleteDocumentOutput::class);


        $exception = new \Exception('error');
        $mockDocumentRepo->shouldReceive('destroy')
            ->once()
            ->with(1)
            ->andThrow($exception);

        $mockFileRepo->shouldReceive('getReleatedToDocumnet')
            ->once()
            ->with(1)
            ->andReturn([]);

        // Assert 
        $error = $exception->getMessage();
        $mockDeleteDocumentOutput->shouldReceive('onFailure')
            ->once()
            ->withArgs( function ($receivedError) use ($error) {
                $this->assertEquals($error, $receivedError);
                return true; 
            });
        // Act
        $usecase = new DeleteDocumentUsecase(
            $mockDocumentRepo,
            $mockFileRepo,
            $fileStorage
        );

        $usecase->delete(1, $mockDeleteDocumentOutput);

    }
}

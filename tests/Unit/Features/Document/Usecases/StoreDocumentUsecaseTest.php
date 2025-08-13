<?php

namespace Tests\Unit\Features\Document\Usecases;

use App\Features\Documents\Application\DTOs\DocumentsStoreInputDTO;
use App\Features\Documents\Application\Output\StoreDocumentOutput;
use App\Features\Documents\Application\Usecases\StoreDocumentUsecase;
use App\Shared\Domain\Entities\DocumentEntity;
use App\Shared\Domain\Repositories\DocumentRepository;
use App\Shared\Domain\Storage\FileStorageContract;
use Mockery;
use PHPUnit\Framework\TestCase;

class  StoreDocumentUsecaseTest extends TestCase
{
    public function test_store_document_on_success()
    {
        //Arrange
        $mockDocumentRepo =  Mockery::mock(DocumentRepository::class);
        $mockFileStorage = Mockery::mock(FileStorageContract::class);
        $mockStoreDocumentOutput = Mockery::mock(StoreDocumentOutput::class);
        $DocumentStoreDTO = new DocumentsStoreInputDTO('', '1', '', []);
        $document = new DocumentEntity(1, 1, '', '', '', 0, []);

        $mockDocumentRepo->shouldReceive('store')
            ->once()
            ->with(
                Mockery::on(function ($arg) {
                    return $arg instanceof DocumentEntity &&
                        $arg->name === '' &&
                        $arg->categoryId === 1 &&
                        $arg->description === '';
                }),
                []
            )
            ->andReturn($document);

        //Assert 
        $mockStoreDocumentOutput->shouldReceive('onSuccess')
            ->once()
            ->withArgs(function ($receivedDocument) use ($document) {
                $this->assertEquals($document, $receivedDocument);
                return true;
            });

        //Act
        $usecase = new StoreDocumentUsecase($mockDocumentRepo, $mockFileStorage);
        $usecase->store($DocumentStoreDTO, $mockStoreDocumentOutput);
    }

    protected function tearDown(): void
    {
        parent::tearDown();
        \Mockery::close(); // Manually closing mockery if needed
    }
}

<?php

namespace Tests\Unit\Features\Document\Usecases;

use App\Features\Documents\Application\Output\CreateDocumentOutput;
use App\Features\Documents\Application\Usecases\CreateDocumentUsecase;
use App\Shared\Domain\Entities\CategoryEntity;
use App\Shared\Domain\Repositories\CategoryRepository;
use Exception;
use Mockery;
use PHPUnit\Framework\TestCase;

class CreateDocumentUsecaseTest extends TestCase
{

    public function test_create_document_on_success(): void
    {
        // Arrange
        $mockCategoryRepo = Mockery::mock(CategoryRepository::class);
        $mockCreateDocumentOutput = Mockery::mock(CreateDocumentOutput::class);

        $mockCategoryRepo->shouldReceive('index')
            ->atLeast()->once()
            ->andReturn([]);

        // Assert
        $mockCreateDocumentOutput->shouldReceive('ReceiveCategories')
            ->once()
            ->with($mockCategoryRepo->index())
            ->withArgs(function ($recivedCategories) {
                $this->assertEquals([], $recivedCategories);
                return true;
            });

        // Act
        $usecase = new CreateDocumentUsecase($mockCategoryRepo);
        $usecase->prepeareCreateForm($mockCreateDocumentOutput);
    }

    public function test_create_document_on_failure(): void
    {
        // Arrange
        $mockCategoryRepo = Mockery::mock(CategoryRepository::class);
        $mockCreateDocumentOutput = Mockery::mock(CreateDocumentOutput::class);

        $exception = new Exception('error');
        $mockCategoryRepo->shouldReceive('index')
            ->once()
            ->andThrow($exception);

        // Assert
        $error = $exception->getMessage();
        $mockCreateDocumentOutput->shouldReceive('onFailure')
            ->with($exception->getMessage())
            ->withArgs(function ($recivedError) use ($error) {
                $this->assertEquals($recivedError, $error);
                return true;
            });

        // Act
        $usecase = new CreateDocumentUsecase($mockCategoryRepo);
        $usecase->prepeareCreateForm($mockCreateDocumentOutput);
    }
    protected function tearDown(): void
    {
        parent::tearDown();
        \Mockery::close(); // Manually closing mockery if needed
    }

}

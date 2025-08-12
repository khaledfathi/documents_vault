<?php

namespace Tests\Unit\Features\Document\Usecases;

use App\Features\Documents\Application\Output\EditDocumentOutput;
use App\Features\Documents\Application\Usecases\EditDocumentUsecase;
use App\Shared\Domain\Entities\CategoryEntity;
use App\Shared\Domain\Entities\DocumentEntity;
use App\Shared\Domain\Entities\FileEntity;
use App\Shared\Domain\Repositories\CategoryRepository;
use App\Shared\Domain\Repositories\DocumentRepository;
use App\Shared\Domain\Repositories\FileRepository;
use Exception;
use Mockery;
use PHPUnit\Framework\TestCase;

class  EditDocumentUsecaseTest extends TestCase
{
    public function test_edit_document_on_sucess(): void
    {
        //Arrange
        $mockDocumentRepo = Mockery::mock(DocumentRepository::class);
        $mockCategoryRepo = Mockery::mock(CategoryRepository::class);
        $mockFileRepo = Mockery::mock(FileRepository::class);
        $file = Mockery::mock(new FileEntity(1, 1, 'file'));
        $mockEditDocumentOutput= Mockery::mock(EditDocumentOutput::class);
        $category = new CategoryEntity(1,'name', 'desc');
        $document = Mockery::mock(
            new DocumentEntity(
                1,
                1,
                'catName',
                'name', 
                'desc', 
                1, 
                [$file])
        );

        $mockDocumentRepo->shouldReceive('show')
            ->once()
            ->with(1)
            ->andReturn($document);

        $mockCategoryRepo->shouldReceive('index')
            ->once()
            ->andReturn([$category]);

        $mockFileRepo->shouldReceive('getReleatedToDocumnet')
            ->once()
            ->with(1)
            ->andReturn([$file]);

        //Assert
        $mockEditDocumentOutput->shouldReceive('onSuccess')
                ->once()
                ->withArgs(function ($receivedDocument , $receivedFile , $receivedCategory) use($document , $file , $category){
                    $this->assertEquals($receivedDocument, $document);
                    $this->assertEquals($receivedFile , [$file]);
                    $this->assertEquals($receivedCategory , [$category]);
                    return true;
                });

        //Act
        $usecase = new EditDocumentUsecase(
            $mockDocumentRepo,
            $mockCategoryRepo,
            $mockFileRepo,
        );
        $usecase->prepareEditForm(1, $mockEditDocumentOutput);
    }
    public function test_edit_document_on_failure(): void {
        //Arrange
        $mockDocumentRepo = Mockery::mock(DocumentRepository::class);
        $mockCategoryRepo = Mockery::mock(CategoryRepository::class);
        $mockFileRepo = Mockery::mock(FileRepository::class);
        $file = Mockery::mock(new FileEntity(1, 1, 'file'));
        $mockEditDocumentOutput= Mockery::mock(EditDocumentOutput::class);

        $exception = new Exception('error');
        $mockDocumentRepo->shouldReceive('show')
            ->once()
            ->with(1)
            ->andThrow($exception);

        $mockCategoryRepo->shouldReceive('index')
            ->once()
            ->andThrow($exception);

        $mockFileRepo->shouldReceive('getReleatedToDocumnet')
            ->once()
            ->with(1)
            ->andThrow($exception);
        //Assert
        $error = $exception->getMessage();
        $mockEditDocumentOutput->shouldReceive('onFailure')
        ->once()
        ->withArgs(function ($receivedError) use ($error){
            $this->assertEquals($error, $receivedError);
            return true;
        });

        //Act
        $usecase = new EditDocumentUsecase(
            $mockDocumentRepo,
            $mockCategoryRepo,
            $mockFileRepo,
        );

        $usecase->prepareEditForm(1, $mockEditDocumentOutput);
    }
}

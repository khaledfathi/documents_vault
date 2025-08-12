<?php

declare(strict_types=1);

namespace Tests\Unit;

use App\Features\Documents\Application\Output\GetAllDocumentOutput;
use App\Features\Documents\Application\Output\ShowDocumentOutput;
use App\Features\Documents\Application\Usecases\GetDocumentUsecase;
use App\Shared\Domain\Entities\DocumentEntity;
use App\Shared\Domain\Entities\FileEntity;
use App\Shared\Domain\Repositories\DocumentRepository;
use Exception;
use Tests\TestCase;
use Mockery;

class GetDocumentUsecaseTest extends TestCase
{
    //mocks
    private $mockRepo;
    private $mockGetAllDocumnetOutput;
    private $mockShowDocumentOutput;
    private $document;
    private $documents;
    //setup test environment 
    protected function setUp(): void
    {
        parent::setUp();
        $this->mockRepo = Mockery::mock(DocumentRepository::class);
        $this->mockGetAllDocumnetOutput = Mockery::mock(GetAllDocumentOutput::class);
        $this->mockShowDocumentOutput = Mockery::mock(ShowDocumentOutput::class);
        $this->document = new DocumentEntity(1, 1, 'cat1', 'name1', 'desc1', 1, [new FileEntity(1, 1, 'file_path')]);
        $this->documents = [$this->document];
    }

    public function test_get_all_document_on_success()
    {

        //prepeare repository  
        $this->mockRepo->shouldReceive('index')
            ->once()
            ->andReturn($this->documents);

        //prepeare output success 
        $this->mockGetAllDocumnetOutput->shouldReceive('onSuccess')
            ->once()
            ->withArgs(function ($receivedDocuments) {
                $this->assertEquals($this->documents, $receivedDocuments);
                return true;
            });

        $useCase = new GetDocumentUsecase($this->mockRepo);

        // Act
        $useCase->all($this->mockGetAllDocumnetOutput);
    }
    public function test_get_all_document_on_failure()
    {

        //prepeare repository  
        $this->mockRepo->shouldReceive('index')
            ->once()
            ->andThrow(new Exception('error'));

        //prepeare output success 
        $error  = 'error';
        $this->mockGetAllDocumnetOutput->shouldReceive('onFailure')
            ->once()->withArgs(function ($recivedError) {
                $this->assertEquals('error', $recivedError);
                return true;
            });

        $useCase = new GetDocumentUsecase($this->mockRepo);

        // Act
        $useCase->all($this->mockGetAllDocumnetOutput);
    }

    public function test_show_document_on_success()
    {

        //prepeare repository  
        $this->mockRepo->shouldReceive('show')
            ->once()
            ->andReturn($this->document);

        //prepeare output success 
        $this->mockShowDocumentOutput->shouldReceive('onSuccess')
            ->once()
            ->withArgs(function ($recivedDocumnet) {
                $this->assertEquals($this->document, $recivedDocumnet);
                return true;
            });
        //Act
        $useCase = new GetDocumentUsecase($this->mockRepo);
        $useCase->show(1, $this->mockShowDocumentOutput);
    }
    public function test_show_document_on_failure()
    {

        //prepeare repository  
        $this->mockRepo->shouldReceive('show')
            ->once()
            ->andThrow(new Exception('error'));
        //prepeare output success 
        $this->mockShowDocumentOutput->shouldReceive('onFailure')
            ->once()
            ->withArgs(function ($recivedError) {
                $this->assertEquals('error' , $recivedError);
                return true; 
            });
        //Act
        $useCase = new GetDocumentUsecase($this->mockRepo);
        $useCase->show(1, $this->mockShowDocumentOutput);
    }
}

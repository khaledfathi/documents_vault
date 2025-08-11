<?php

declare(strict_types=1);

namespace App\Features\Documents\Presentation\Http\Controllers; 

use App\Features\Documents\Application\Contracts\CreateDocumentContract;
use App\Features\Documents\Application\Contracts\DeleteDocumentContract;
use App\Features\Documents\Application\Contracts\EditDocumentContract;
use App\Features\Documents\Application\Contracts\GetDocumentContract;
use App\Features\Documents\Application\Contracts\StoreDocumentContract;
use App\Features\Documents\Application\Contracts\UpdateDocumentContract;
use App\Features\Documents\Application\DTOs\DocumentFileDTO;
use App\Features\Documents\Application\DTOs\DocumentsStoreInputDTO;
use App\Features\Documents\Presentation\Http\Requests\DocumentStoreRequest;
use App\Features\Documents\Presentation\Http\Requests\DocumentUpdateRequest;
use App\Features\Documents\Presentation\Presenters\DocumentCreatePresenter;
use App\Features\Documents\Presentation\Presenters\DocumentEditPresenter;
use App\Features\Documents\Presentation\Presenters\DocumentIndexPresenter;
use App\Features\Documents\Presentation\Presenters\DocumentShowPresenter;
use App\Features\Documents\Presentation\Presenters\DocumentStorePresenter;
use App\Features\Documents\Presentation\Presenters\DocumentUpdatePresenter;
use App\Features\Documents\Presentation\Presenters\DocumnetDestroyPresenter;
use App\Http\Controllers\Controller;
use App\Shared\Domain\Entities\DocumentEntity;

class DocumentController extends Controller
{
    public function __construct(
        private GetDocumentContract $getDocumentUsecase,
        private StoreDocumentContract $storeDocumentUsecase,
        private DeleteDocumentContract $deleteDocumentUsecase,
        private CreateDocumentContract $getCategoryUsecase,
        private EditDocumentContract $editDocumentUsecase,
        private UpdateDocumentContract $updateDocumentUsecase,
    ) {}
    public function index()
    {
        $presenter = new DocumentIndexPresenter();
        $this->getDocumentUsecase->all($presenter);
        return $presenter->handle();
    }

    public function create()
    {
        $presenter = new DocumentCreatePresenter();
        $this->getCategoryUsecase->prepeareCreateForm($presenter);
        return $presenter->handle();
    }

    public function store(DocumentStoreRequest $request)
    
    {
        //recieve files 
        $files = array_map(
            fn($file) => new DocumentFileDTO(
                $file->getClientOriginalName(),
                $file->getContent(),
                $file->getClientMimeType(),
            ),
            $request->file('file') ?? []
        );

        //transfare document request to object 
        $dto = new DocumentsStoreInputDTO(
            $request->name,
            $request->category_id,
            $request->description ?? '',
            $files ?? [],
        );

        //---- exec ---- 
        $presenter = new DocumentStorePresenter();
        $this->storeDocumentUsecase->store($dto, $presenter);
        return $presenter->handle();
    }

    public function show(string $id)
    {
        $presenter = new DocumentShowPresenter();
        $this->getDocumentUsecase->show((int)$id, $presenter);
        return $presenter->handle();
    }

    public function edit(string $id)
    {
        $presenter = new DocumentEditPresenter();
        $this->editDocumentUsecase->prepareEditForm((int)$id, $presenter);
        return $presenter->handle();
    }

    public function update(DocumentUpdateRequest $request, string $id)
    {
        //documnet data
        $documnetData = new DocumentEntity(
            id : (int) $id,
            name: $request->name,
            categoryId: (int) $request->category_id,
            description: $request->description,
        );

        //
        $filesToDelete = json_decode($request->delete_files_list ?? '[]');

        //new File DTO
        $newFiles = array_map(
            fn($file) => new DocumentFileDTO(
                $file->getClientOriginalName(),
                $file->getContent(),
                $file->getClientMimeType(),
            ),
            $request->file('file') ?? []
        );

        // ---- execution ----
        $presenter = new DocumentUpdatePresenter();
        $this->updateDocumentUsecase->update(
            $documnetData,
            $filesToDelete,
            $newFiles,
            $presenter
        );
        return $presenter->handle();
    }

    public function destroy(string $id)
    {

        $presenter = new DocumnetDestroyPresenter();
        $this->deleteDocumentUsecase->delete((int)$id, $presenter);
        return $presenter->handle();
    }
}

<?php

declare(strict_types=1);

namespace App\Features\Documents\Presentation\Http\Controllers;

use App\Constants\Constants;
use App\Features\Documents\Application\Contracts\CreateDocumentContract;
use App\Features\Documents\Application\Contracts\DeleteDocumentContract;
use App\Features\Documents\Application\Contracts\GetDocumentContract;
use App\Features\Documents\Application\Contracts\StoreDocumentContract;
use App\Features\Documents\Application\DTOs\DocumentFileDTO;
use App\Features\Documents\Application\DTOs\DocumentsStoreInputDTO;
use App\Features\Documents\Infrastructure\Models\Category;
use App\Features\Documents\Infrastructure\Models\Document;
use App\Features\Documents\Infrastructure\Models\File;
use App\Features\Documents\Presentation\Http\Requests\DocumentStoreRequest;
use App\Features\Documents\Presentation\Http\Requests\DocumentUpdateRequest;
use App\Features\Documents\Presentation\Presenters\DocumentCreatePresenter;
use App\Features\Documents\Presentation\Presenters\DocumentIndexPresenter;
use App\Features\Documents\Presentation\Presenters\DocumentShowPresenter;
use App\Features\Documents\Presentation\Presenters\DocumentStorePresenter;
use App\Features\Documents\Presentation\Presenters\DocumnetDestroyPresenter;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class DocumentController extends Controller
{
    public function __construct(
        private GetDocumentContract $getDocumentUsecase,
        private StoreDocumentContract $storeDocumentUsecase,
        private DeleteDocumentContract $deleteDocumentUsecase,
        private CreateDocumentContract $getCategoryUsecase
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
            $request->description,
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
        return view('documents.edit', [
            'document' => Document::where('documents.id', $id)->withCategoryName()?->first(),
            'categories' => Category::all(),
            'storage' => Constants::DOCUMENTS_PUBLIC_PATH,
        ]);
    }

    public function update(DocumentUpdateRequest $request, string $id)
    {
        // delete files 
        $deleteFilesList = json_decode($request->input('delete_files_list', '[]'),);
        foreach ($deleteFilesList as $fileId) {
            $file = File::find($fileId);
            if ($file) {
                Storage::disk('public')->delete(Constants::DOCUMENTS_PATH . DIRECTORY_SEPARATOR . $file->file);
                $file->delete();
            }
        }

        // handle new files
        if ($request->hasFile("file")) {
            foreach ($request->file("file") as $file) {
                $fileName = time() . "_" . $file->getClientOriginalName();
                Storage::disk("public")->putFileAs(Constants::DOCUMENTS_PATH, $file, $fileName);
                File::create([
                    'file' => $fileName,
                    'document_id' => $id,
                ]);
            }
        }
        //update document
        Document::find($id)?->update($request->except('file', 'delete_files_list'));

        return redirect()->route('documents.index')->with('success', 'Document updated successfully.');
    }

    public function destroy(string $id)
    {

        $presenter = new DocumnetDestroyPresenter();
        $this->deleteDocumentUsecase->delete((int)$id, $presenter);
        return $presenter->handle();
    }
}

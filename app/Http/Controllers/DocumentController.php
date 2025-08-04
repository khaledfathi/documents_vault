<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\constants\Constants;
use App\Http\Requests\Documents\DocumentStoreRequest;
use App\Http\Requests\Documents\DocumentUpdateRequest;
use App\Models\Category;
use App\Models\Document;
use App\Models\File;
use Illuminate\Support\Facades\Storage;

class DocumentController extends Controller
{
    public function index()
    {
        $documents = Document::withCategoryName()->get();;
        return view("documents.index ", ["documents" => $documents]);
    }

    public function create()
    {
        return view("documents.create", ["categories" => Category::all()]);
    }

    public function store(DocumentStoreRequest $request)
    {
        $record = Document::create($request->except('file'));
        // handle files
        if ($request->hasFile("file")) {
            foreach ($request->file("file") as $file) {
                $fileName = time() . "_" . $file->getClientOriginalName();
                Storage::disk("public")->putFileAs(Constants::DOCUMENTS_PATH, $file, $fileName);
                File::create([
                    'file' => $fileName,
                    'document_id' => $record->id,
                ]);
            }
        }
        return redirect()->route('documents.index')->with('success', 'Document created successfully.');
    }

    public function show(string $id)
    {
        return view("documents.show", [
            'document' => Document::where('documents.id', $id)->withCategoryName()?->first(),
            'storage' => Constants::DOCUMENTS_PUBLIC_PATH,
        ]);
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
        $document = Document::findOrFail($id);

        if ($document) {
            //delete associated files
            foreach ($document->files as $file) {
                Storage::disk('public')->delete(Constants::DOCUMENTS_PATH . DIRECTORY_SEPARATOR . $file->file);
                $file->delete();
            }
            //delete record 
            $document->delete();
        }
        return redirect()->route('documents.index')->with('success', 'Document deleted successfully.');
    }
}

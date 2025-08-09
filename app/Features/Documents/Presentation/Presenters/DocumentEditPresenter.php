<?php
declare(strict_types=1);

namespace App\Features\Documents\Presentation\Presenters;

use App\Constants\Constants;
use App\Features\Documents\Application\Output\EditDocumentOutput;
use App\Features\Documents\Domain\Entities\CategoryEntity;
use App\Features\Documents\Domain\Entities\DocumentEntity;
use App\Features\Documents\Domain\Entities\FileEntity;
use Illuminate\View\View;

class DocumentEditPresenter implements EditDocumentOutput {

    private $data = [
        'document' => null,  
        'files' => null,  
        'categories' => null ,
        'storage' => Constants::DOCUMENTS_PUBLIC_PATH,
        'error' => null,
        'serverError' => null,
        // 'document' => document::where('documents.id', $id)->withcategoryname()?->first(),
        // 'categories' => category::all(),
        // 'storage' => constants::documents_public_path,
    ];
    /**
     *
     * @param DocumentEntity $documents
     * @param array<FileEntity> $documents
     * @param array<CategoryEntity> $categories
     * @return void
     */
    public function onSuccess (DocumentEntity $documents, array $files , array $categories):void {
        $this->data['document'] = $documents;
        $this->data['files'] = $files;
        $this->data['categories'] = $categories;
    }
    public function onFailure(string $error):void{
       $this->data['error'] = 'Internal server error , contact system administrator.';
       $this->data['serverError'] = $error;
    }

    public function handle ():View{
        return view('documents.edit', $this->data);
    }
}
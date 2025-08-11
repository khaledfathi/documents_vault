<?php
declare(strict_types=1);

namespace App\Features\Documents\Presentation\Presenters;

use App\Features\Documents\Application\Output\EditDocumentOutput;
use App\Shared\Domain\Constants\Constants;
use App\Shared\Domain\Entities\CategoryEntity;
use App\Shared\Domain\Entities\DocumentEntity;
use App\Shared\Domain\Entities\FileEntity;
use Illuminate\View\View;

class DocumentEditPresenter implements EditDocumentOutput {

    private $data = [
        'document' => null,  
        'files' => null,  
        'categories' => null ,
        'storage' => Constants::DOCUMENTS_PUBLIC_PATH,
        'error' => null,
        'serverError' => null,
    ];
    /**
     *
     * @param DocumentEntity $documents
     * @param array<FileEntity> $files
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
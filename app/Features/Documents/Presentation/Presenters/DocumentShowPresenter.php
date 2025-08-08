<?php

declare(strict_types=1);

namespace App\Features\Documents\Presentation\Presenters;

use App\Constants\Constants;
use App\Features\Documents\Application\Output\ShowDocumentOutput;
use App\Features\Documents\Domain\Entities\DocumentEntity;
use Illuminate\View\View;

class DocumentShowPresenter implements ShowDocumentOutput
{
    private $data = [
        'document'=>null ,
        'storage' => Constants::DOCUMENTS_PUBLIC_PATH,
        'serverError'=> null,
    ];
    public function onSuccess(DocumentEntity $document): void {
        $this->data['document'] = $document;
    }
    public function onFailure(string $error): void {
        $this->data['error'] = 'Internal server error, contact system administrator ' ;
        $this->data['serverError'] = $error;
    }
    public function handle(): View
    {
        return view('documents.show', $this->data);
    }
}

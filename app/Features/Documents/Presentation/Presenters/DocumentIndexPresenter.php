<?php
declare(strict_types=1);

namespace App\Features\Documents\Presentation\Presenters;

use App\Features\Documents\Application\Output\GetAllDocumentOutput;
use App\Features\Documents\Domain\Entities\DocumentEntity;
use Illuminate\View\View;

class DocumentIndexPresenter implements GetAllDocumentOutput{

    private array $data = ['documents'=> null, 'error'=>null , 'serverError'=>null];
    /**
     * 
     * @param array<DocumentEntity> $documents
     * @return void
     */
    public function onSuccess(array $documents): void{
        $this->data['documents'] = $documents;
    }
    public function onFailure(string $error): void{
        dd($error);
        $this->data['error'] = 'Internal server error , contact system administrator';
        $this->data['serverError'] = $error;
    }

    public function handle ():View {
        // dd($this->data);
        return view('documents.index', $this->data);
    }
}

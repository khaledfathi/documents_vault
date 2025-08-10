<?php
declare(strict_types=1);
 
namespace App\Features\Documents\Presentation\Presenters;

use App\Features\Documents\Application\Output\StoreDocumentOutput;
use App\Features\Documents\Domain\Entities\DocumentEntity;

class DocumentStorePresenter implements StoreDocumentOutput{

    private $data = [];
    public function onSucess(DocumentEntity $document): void{
        //repo store 
        $this->data['success'] =  'Document created successfully.'; 
        $this->data['document'] = $document; 
    }
    public function onFailure(string $error): void{
        $this->data['error'] =  'internal server error , contact system adminstrator.';
        $this->data['serverError'] = $error;
    }
    public function handle (){
        return redirect()->route('documents.index' , $this->data); 
    }
}
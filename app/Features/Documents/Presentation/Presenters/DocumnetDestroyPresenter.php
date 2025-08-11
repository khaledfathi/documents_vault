<?php
declare (strict_types= 1);

namespace App\Features\Documents\Presentation\Presenters;

use App\Features\Documents\Application\Output\DeleteDocumentOutput;

class DocumnetDestroyPresenter implements DeleteDocumentOutput {
    private $data =  [
        'affectedRecords' => 0,
    ];

    public function onSuccess(int $affectedCount): void{
        $this->data['affectedRecords'] = $affectedCount;
        $this->data['success'] = 'Document deleted successfully.' ;
    }
    public function onFailure(string $error): void{
        $data['error']  = 'Internal server error , contact system administrator';
        $data['serverError']  = $error ;
    }
    public function handle () {
        return redirect()->route('documents.index', $this->data);
    }
}

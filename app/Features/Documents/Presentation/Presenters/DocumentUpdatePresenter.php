<?php
declare(strict_types= 1);

namespace App\Features\Documents\Presentation\Presenters;

use App\Features\Documents\Application\Output\UpdateDocumentOutput;
use Illuminate\Http\RedirectResponse;

class DocumentUpdatePresenter implements UpdateDocumentOutput{
    private $data = [
        'success' => null,
        'error'=> null,
        'serverError'=>null,
    ];

    public function onSuccess(int $affectedCount):void{
        $this->data['success'] = $affectedCount;
    }

    public function onFailure(string $error):void{
        $this->data['error'] = 'Internal server error , contact system administrator ';
        $this->data['serverError'] = $error;
    }

    public function handle ():RedirectResponse{
        return redirect()->route('documents.index' , $this->data);
    }

}
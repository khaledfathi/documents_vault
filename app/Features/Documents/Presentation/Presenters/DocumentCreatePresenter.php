<?php
declare (strict_types= 1);

namespace App\Features\Documents\Presentation\Presenters;

use App\Features\Documents\Application\Output\CreateDocumentOutput;
use App\Shared\Domain\Entities\CategoryEntity;
use Illuminate\View\View;

class DocumentCreatePresenter implements CreateDocumentOutput{
    private $data= ['categories'=>[]];
    /**
     * 
     * @param array<CategoryEntity> $output
     * @return void
     */
    public function ReceiveCategories(array $categories):void{
        $this->data['categories']= $categories;
    }
    public function onFailure(string $error):void{
        //
    }
    public function handle():View{
        return view("documents.create", $this->data);
    }

}
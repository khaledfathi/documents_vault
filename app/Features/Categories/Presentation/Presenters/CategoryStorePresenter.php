<?php
declare (strict_types= 1);
namespace App\Features\Categories\Presentation\Presenters;

use App\Features\Categories\Application\Outputs\StoreCategoryOutput;
use App\Shared\Domain\Entities\CategoryEntity;

class CategoryStorePresenter implements StoreCategoryOutput {
    private $data =[
        'category' => null,
        'success'=> null,
        'error'=> null,
        'serverError' => null
    ];

    public function onSuccess(CategoryEntity $category):void {
        $this->data['category'] = $category;
        $this->data['success'] = true;
    }

    public function onFailure(string $error):void {
        $this->data['error'] = 'internal server error';
        $this->data['errorServer'] = $error;
    }

    public function handle (){
        return redirect()->route('categories.index', $this->data);
    }
}
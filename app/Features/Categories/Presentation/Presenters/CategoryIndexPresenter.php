<?php
declare (strict_types= 1);
namespace App\Features\Categories\Presentation\Presenters;

use App\Features\Categories\Application\Outputs\GetAllCategoryOutput;
use App\Shared\Domain\Entities\CategoryEntity;
use Illuminate\View\View;

class CategoryIndexPresenter implements GetAllCategoryOutput{
    private $data= [
        'categories' => null,
        'error'=> null,
        'serverError' => null
    ];
    /**
     * 
     * @param array $categories
     * @return array<CategoryEntity>
     */
    public function onSuccess(array $categories):void {
        $this->data['categories'] = $categories;
    }
    
    public function onFailure(string $error):void {
        $this->data['error'] = 'Internal server error , contact system administrator';
        $this->data['serverError'] = $error;
    }
    public function handle ():View{
        return view("categories.index" , $this->data);
    }
}
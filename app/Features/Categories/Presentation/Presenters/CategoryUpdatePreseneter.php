<?php
declare (strict_types= 1);

namespace App\Features\Categories\Presentation\Presenters;

use App\Features\Categories\Application\Outputs\UpdateCategoryOutput;
use Illuminate\Http\RedirectResponse;

class  CategoryUpdatePreseneter implements UpdateCategoryOutput {
    private $data = [
        "affectedCount" => null,
        "success" => null, 
        "error" => null,
        "serverError" => null,
    ];
    public function onSucess(int $affectedCount): void{
       $this->data['success']  = 'Category updated successfully.';
       $this->data['affectedCount'] = $affectedCount;
    }
    public function onFailure(string $error): void{
        $this->data['error'] = 'Internal server error , contact system administrator.';
        $this->data['serverError'] = $error;
    }
    public function handle ():RedirectResponse{

        return redirect()->route('categories.index')->with('success',);
    }

} 
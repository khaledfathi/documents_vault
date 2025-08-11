<?php
declare (strict_types= 1);

namespace App\Features\Categories\Presentation\Presenters;

use App\Features\Categories\Application\Outputs\DestroyCategoryOutput;
use Illuminate\Http\RedirectResponse;

class CategoryDestroyPresenter implements DestroyCategoryOutput {

    private $errors = [];
    private $success= null;
    public function onTryingDeleteDefaultCategory (string $errorMessage): void{
        $this->errors[] = $errorMessage;
    }
    public function onSuccess (int $affectedCount):void {
        $this->success = $affectedCount;
    }
    public function onFailure (string $error):void {
        $this->errors[] = 'Internal server error, contact system administrator' ;
        // $this->errors[] = $error;
    }

    public function handle ():RedirectResponse{
        $redirect = redirect()->route('categories.index' );
        $this->errors ? $redirect->withErrors($this->errors) : $redirect->with('success', $this->success) ;
        return $redirect;

    }
}
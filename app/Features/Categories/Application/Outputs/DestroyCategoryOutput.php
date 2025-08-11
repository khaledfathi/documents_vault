<?php
declare (strict_types= 1);

namespace App\Features\Categories\Application\Outputs;

interface DestroyCategoryOutput {
    public function onTryingDeleteDefaultCategory (string $errorMessage): void;
    public function onSuccess (int $affectedCount):void ; 
    public function onFailure (string $error):void ; 

}
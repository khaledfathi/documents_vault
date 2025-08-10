<?php
declare(strict_types=1);

namespace App\Features\Documents\Domain\Repositories;

use App\Features\Documents\Domain\Entities\DocumentEntity;
use App\Features\Documents\Domain\Entities\FileEntity;

interface DocumentRepository{
    /**
     *
     * @return array<DocumentEntity> 
     */
    public function index(): array;  
    
    /**
     *
     * @param \App\Features\Documents\Domain\Entities\DocumentEntity $document
     * @param array<string> $file
     * @return DocumentEntity
     */
    public function store(DocumentEntity $document , array $fileNames):DocumentEntity;
    public function show (int  $id):DocumentEntity;


    public function update (DocumentEntity $document ):int;

    /**
     * Summary of destroy
     * @param int $id
     * @return int count of affected fields  
     */
    public function destroy(int  $id):int;
}

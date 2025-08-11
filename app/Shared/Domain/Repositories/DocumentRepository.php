<?php
declare(strict_types=1);

namespace App\Shared\Domain\Repositories;

use App\Shared\Domain\Entities\DocumentEntity;

interface DocumentRepository{
    /**
     *
     * @return array<DocumentEntity> 
     */
    public function index(): array;  
    
    /**
     *
     * @param  $document
     * @param array<string> $file
     * @return 
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

    public function moveDocumentsFromCategoryToDefault (int $categoryId , int $defaultCategoryId):int;
}

<?php
declare (strict_types= 1);
namespace App\Shared\Domain\Repositories;

use App\Shared\Domain\Entities\CategoryEntity;

interface  CategoryRepository{
    /**
     *
     * @return array<CategoryEntity>
     */
    public  function index ():array;
    public  function store(CategoryEntity $category):CategoryEntity;
    public function update(CategoryEntity $category):int;
    public function destroy(int $id):int;
}
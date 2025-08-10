<?php
declare (strict_types= 1);
namespace App\Features\Documents\Domain\Repositories;

use App\Features\Documents\Domain\Entities\CategoryEntity;

interface  CategoryRepository{
    /**
     *
     * @return array<CategoryEntity>
     */
    public  function index ():array;
}
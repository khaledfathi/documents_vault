<?php

declare(strict_types=1);

namespace App\Features\Documents\Infrastructure\Repositories;

use App\Features\Documents\Domain\Entities\CategoryEntity;
use App\Features\Documents\Domain\Repositories\CategoryRepository;
use App\Features\Documents\Infrastructure\Models\Category;

class EloquentCategoryRepository implements CategoryRepository
{

    /**
     *
     * @return array<CategoryEntity>
     */
    public  function index(): array
    {
        $categoriesRecords = Category::select()->get();
        $categoriesArray =[]; 
        foreach ($categoriesRecords as $category) {
            $categoriesArray[] = new CategoryEntity(
                $category->id,
                $category->name,
                $category->description
            );
        }
        return $categoriesArray;
    }
}

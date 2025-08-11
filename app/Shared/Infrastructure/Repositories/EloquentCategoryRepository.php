<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Repositories; 

use App\Shared\Domain\Entities\CategoryEntity;
use App\Shared\Domain\Repositories\CategoryRepository;
use App\Shared\Infrastructure\Models\Category;
use App\Shared\Infrastructure\Models\Document;

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

    public  function store(CategoryEntity $category):CategoryEntity{
        $record = Category::create([
            "name"=> $category->name,
            "description"=> $category->description
        ]);
        $category->id = $record->id;
        return $category;
    }

    public function update(CategoryEntity $category):int{
        return Category::where( 'id', $category->id )->update([
            "name"=> $category->name
        ]) ?? 0 ;
    }

    public function destroy(int $id):int{
        return Category::where('id', $id)?->delete() ?? 0;
    }
}

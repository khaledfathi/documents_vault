<?php

declare(strict_types=1);

namespace App\Features\Categories\Presentation\Http\Controller;

use App\Features\Categories\Application\Contracts\DestroyCategoryContract;
use App\Features\Categories\Application\Contracts\GetCategoryContract;
use App\Features\Categories\Application\Contracts\StoreCategoryContract;
use App\Features\Categories\Application\Contracts\UpdateCategoryContract;
use App\Features\Categories\Presentation\Http\Requests\CategoryStoreRequest;
use App\Features\Categories\Presentation\Http\Requests\CategoryUpdateRequest;
use App\Features\Categories\Presentation\Presenters\CategoryDestroyPresenter;
use App\Features\Categories\Presentation\Presenters\CategoryIndexPresenter;
use App\Features\Categories\Presentation\Presenters\CategoryStorePresenter;
use App\Features\Categories\Presentation\Presenters\CategoryUpdatePreseneter;
use App\Http\Controllers\Controller;
use App\Shared\Domain\Entities\CategoryEntity;
use App\Shared\Infrastructure\Models\Category;
use App\Shared\Infrastructure\Models\Document;

class CategoryController extends Controller
{
    public function __construct(
        private GetCategoryContract $getCategoryUsecase,
        private StoreCategoryContract $storeCategoryUsecase,
        private UpdateCategoryContract  $updateCategoryUsecase,
        private DestroyCategoryContract $destroyCategoryUsecase,
    ) {}
    public function index()
    {
        $presenter = new CategoryIndexPresenter();
        $this->getCategoryUsecase->all($presenter);
        return $presenter->handle();
    }

    public function create()
    {
        return view("categories.create");
    }

    public function store(CategoryStoreRequest $request)
    {
        //DTO
        $category =  new CategoryEntity(name: $request->name,);
        //
        $presenter = new CategoryStorePresenter();
        $this->storeCategoryUsecase->store($category, $presenter);
        return $presenter->handle();
    }

    public function edit(string $id)
    {
        return view("categories.edit", ["category" => Category::find($id)]);
    }

    public function update(CategoryUpdateRequest $request, string $id)
    {
        //DTO 
        $category = new CategoryEntity(id: (int)$id, name: $request->name);
        //
        $presenter = new CategoryUpdatePreseneter();
        $this->updateCategoryUsecase->update($category, $presenter);
        return $presenter->handle();
    }

    public function destroy(string $id)
    {
        $presenter = new CategoryDestroyPresenter();
        $this->destroyCategoryUsecase->delete((int)$id,$presenter);
        return $presenter->handle();
    }
}

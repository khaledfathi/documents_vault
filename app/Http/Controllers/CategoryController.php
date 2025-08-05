<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\Categories\CategoryUpdateRequest;
use App\Models\Category;
use App\Models\Document;

class CategoryController extends Controller
{
    public function index()
    {
        return view("categories.index" , ["categories"=> Category::all()]);
    }

    public function create()
    {
        return view("categories.create");
    }

    public function store(CategoryUpdateRequest $request)
    {
        Category::create(["name" => $request->name]);
        return redirect()->route('categories.index')->with('success', 'Category created successfully.');
    }

    public function edit(string $id)
    {
        return view("categories.edit" , ["category"=> Category::find($id)]);
    }

    public function update(CategoryUpdateRequest $request, string $id)
    {
        Category::find($id)?->update(["name" => $request->name]);
        return redirect()->route('categories.index')->with('success', 'Category updated successfully.');
    }

    public function destroy(string $id)
    {
        $category = Category::findOrFail($id);
        if($id == Category::defaultCategoryId()){
            return  redirect()->route('categories.index')->withErrors('Can not delete default category.');
        }
        // shift all documents to default category before deleting 
        if($category){
            Document::where('category_id', $id)->update(['category_id' => Category::defaultCategoryId()]);
            $category->delete();
        }
        return  redirect()->route('categories.index')->with('success','Category deleted successfully.');
    }

}

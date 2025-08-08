<?php
declare(strict_types= 1);


namespace App\Http\Controllers;

use App\Features\Documents\Infrastructure\Models\Category;
use App\Features\Documents\Infrastructure\Models\Document;
use App\Features\Documents\Infrastructure\Models\File;

class HomeController extends Controller
{
    public function index()
    {
        Document::count();
        return view("home.index", [
            'documentsCount' => Document::count(),
            'categoriesCount' => Category::count(),
            'filesCount' => File::count(),
        ]);
    }
}

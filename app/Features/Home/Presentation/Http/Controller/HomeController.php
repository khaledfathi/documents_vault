<?php
declare(strict_types= 1);


namespace App\Features\Home\Presentation\Http\Controller; 

use App\Http\Controllers\Controller;
use App\Shared\Infrastructure\Models\Category;
use App\Shared\Infrastructure\Models\Document;
use App\Shared\Infrastructure\Models\File;

class HomeController extends Controller 
{
    public function index()
    {
        return view("home.index", [
            'documentsCount' => Document::count(),
            'categoriesCount' => Category::count(),
            'filesCount' => File::count(),
        ]);
    }
}

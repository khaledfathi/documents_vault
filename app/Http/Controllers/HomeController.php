<?php
declare(strict_types= 1);


namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Document;
use App\Models\File;
use Illuminate\Http\Request;

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

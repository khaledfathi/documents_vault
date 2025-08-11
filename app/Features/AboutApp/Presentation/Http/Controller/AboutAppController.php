<?php

namespace App\Features\AboutApp\Presentation\Http\Controller; 

use App\Http\Controllers\Controller;

class AboutAppController extends Controller
{
    public function index() {
        return view("about-app.index");
    }
}

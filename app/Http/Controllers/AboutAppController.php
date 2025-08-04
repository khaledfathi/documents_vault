<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AboutAppController extends Controller
{
    public function index() {
        return view("about-app.index");
    }
}

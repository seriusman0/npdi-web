<?php

namespace App\Http\Controllers;

use App\Support\Portfolio;

class HomeController extends Controller
{
    public function index()
    {
        return view('pages.home', ['projects' => Portfolio::$projects]);
    }
}

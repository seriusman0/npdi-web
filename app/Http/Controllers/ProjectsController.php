<?php

namespace App\Http\Controllers;

use App\Support\Portfolio;

class ProjectsController extends Controller
{
    public function index()
    {
        return view('pages.projects', ['projects' => Portfolio::$projects]);
    }
}

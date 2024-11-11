<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ViewController extends Controller
{
    public function showIndexView()
    {
        return view('index');
    }

    public function showReadView()
    {
        return view('ebook.read');
    }
}

<?php

namespace App\Http\Controllers;

use App\News;
use App\CategoryNews;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function getIndex()
    {

        $category = CategoryNews::query()->get();

        return view('index') -> with('categories', $category);
    }
}

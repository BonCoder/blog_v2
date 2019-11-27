<?php

namespace App\Http\Controllers\Home;

use App\Models\Article;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    public function index()
    {

        return view('home.index',['keywords' => $this->keywords]);
    }

    public function article($id)
    {
        $article = Article::query()->findOrFail($id);

        return view('home.article.index',compact('article'));
    }



}

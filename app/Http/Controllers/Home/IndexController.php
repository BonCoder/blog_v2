<?php

namespace App\Http\Controllers\Home;

use App\Models\Article;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    public function index()
    {
        return '前台主页，暂无内容';
    }

    public function article()
    {
        $article = Article::query()->orderBy('created_at','desc')->first();

        return view('home.article.index',compact('article'));
    }



}

<?php
/**
 * @Author Bob
 * @Date: 2018/11/21
 * @Email  bob@bobcoder.cc
 * @Site https://www.bobcoder.cc/
 */
namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function detail(Request $request, Article $article)
    {
        $article->load(['source', 'user', 'category', 'tags']);

        $article->increment('click', rand(2,5));

        return response()->json($article, 200);
    }
}
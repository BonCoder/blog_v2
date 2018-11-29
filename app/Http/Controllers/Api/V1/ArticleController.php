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
    public function detail(Article $article)
    {
        $data = $article->with(['tags','category'])->first();
        $article->increment('click',1);

        return response()->json($data, 200);
    }
}
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

class IndexController extends Controller
{
    /**
     *
     * @param Request $request
     * @param Article $article
     * @return \Illuminate\Http\JsonResponse
     * @author   Bob<bob@bobcoder.cc>
     */
    public function index(Request $request, Article $article)
    {
        $limit = $request->query('limit',5);
        $offset = $request->query('offset', 0);

        $model = Article::query();

        if ($request->get('category_id')){
            $model = $model->where('category_id',$request->get('category_id'));
        }
        if ($request->get('title')){
            $model = $model->where('title','like','%'.$request->get('title').'%');
        }

        $result = $model->orderBy('created_at','desc')
            ->with(['tags','category'])
            ->limit($limit)
            ->offset($offset)
            ->get();

        return response()->json($result,200);
    }
}
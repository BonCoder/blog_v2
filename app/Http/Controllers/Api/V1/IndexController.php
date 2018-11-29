<?php
/**
 * @Author Bob
 * @Date: 2018/11/21
 * @Email  bob@bobcoder.cc
 * @Site https://www.bobcoder.cc/
 */

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Advert;
use App\Models\Article;
use App\Models\Links;
use App\Models\Tag;
use Illuminate\Http\Request;

class IndexController extends Controller
{

    /**
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @author   Bob<bob@bobcoder.cc>
     */
    public function index(Request $request)
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


    /**
     * @param Request $request
     * @param Advert $advert
     * @return \Illuminate\Http\JsonResponse
     * @author  Bob<bob@bobcoder.cc>
     */
    public function adverts(Request $request, Advert $advert)
    {
        $position_id = (int)$request->query('position_id',1);

        $result = $advert->where('position_id',$position_id)->orderBy('sort','desc')->get();

        return response()->json($result,200);
    }

    /**
     * @param Tag $tag
     * @return \Illuminate\Http\JsonResponse
     * @author  Bob<bob@bobcoder.cc>
     */
    public function tag(Tag $tag)
    {
        $result = $tag->orderBy('sort','desc')->get();

        return response()->json($result,200);
    }

    /**
     * @param Links $links
     * @return \Illuminate\Http\JsonResponse
     * @author   Bob<bob@bobcoder.cc>
     */
    public function links(Links $links)
    {
        $result = $links->where('status',1)->orderBy('sort','desc')->get();

        return response()->json($result,200);
    }


}
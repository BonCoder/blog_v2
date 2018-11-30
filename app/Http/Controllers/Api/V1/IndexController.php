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
     * @param Article $article
     * @return \Illuminate\Http\JsonResponse
     * @author   Bob<bob@bobcoder.cc>
     */
    public function index(Request $request,Article $article)
    {
        $limit = $request->query('limit',10);
        $offset = $request->query('offset', 0);
        $category_id = (int)$request->get('category_id','');
        $tag_id = (int)$request->get('tag_id','');
        $title = (string)$request->get('title','');

        $result = $article
            ->when($title,function ($query) use ($title){
                $query->where('title','like','%'.$title.'%');
            })
            ->when($category_id,function ($query) use ($category_id){
                $query->where('category_id',$category_id);
            })
            ->when($tag_id,function ($query) use ($tag_id){
                $query->select('articles.*','article_tag.tag_id')
                    ->leftJoin('article_tag','articles.id','=','article_tag.article_id')
                    ->where('article_tag.tag_id',$tag_id);
            })
            ->where('status',1)
            ->orderBy('created_at','desc')
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
        $result = $tag->orderBy('sort','desc')->orderBy('created_at','desc')->get();

        return response()->json($result,200);
    }

    /**
     * @param Links $links
     * @return \Illuminate\Http\JsonResponse
     * @author   Bob<bob@bobcoder.cc>
     */
    public function links(Links $links)
    {
        $result = $links->where('status',1)->orderBy('sort','desc')->orderBy('created_at','desc')->get();

        return response()->json($result,200);
    }


}
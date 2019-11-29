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
use App\Models\Site;
use App\Models\Tag;
use Illuminate\Http\Request;

class IndexController extends Controller
{

    /**
     *首页文章列表
     * @param Request $request
     * @param Article $article
     * @return \Illuminate\Http\JsonResponse
     * @author   Bob<bob@bobcoder.cc>
     */
    public function index(Request $request, Article $article)
    {
        $limit = $request->query('limit', 10);
        $offset = $request->query('offset', 0);
        $category_id = (int)$request->get('category_id', '');
        $tag_id = (int)$request->get('tag_id', '');
        $title = (string)$request->get('title', '');

        $result = $article
            ->when($title, function ($query) use ($title) {
                $query->where('title', 'like', '%' . $title . '%');
            })
            ->when($category_id, function ($query) use ($category_id) {
                $query->where('category_id', $category_id);
            })
            ->when($tag_id, function ($query) use ($tag_id) {
                $query->select('articles.*', 'article_tag.tag_id')
                    ->leftJoin('article_tag', 'articles.id', '=', 'article_tag.article_id')
                    ->where('article_tag.tag_id', $tag_id);
            })
            ->where('status', 1)
            ->orderBy('created_at', 'desc')
            ->with(['tags', 'category', 'user'])
            ->paginate(5);

        return response()->json($result, 200);
    }

    /**
     * 推荐文章
     *
     * @param Article $article
     * @return \Illuminate\Http\JsonResponse
     * @author   Bob<bob@bobcoder.cc>
     * @link https://www.bobcoder.cc/
     * @Date  2019/11/29
     */
    public function recommend(Article $article)
    {
        $list = $article
            ->where(['status' => 1, 'recommend' => 1])
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json($list, 200);
    }


    /**
     * 广告banner
     * @param Request $request
     * @param Advert $advert
     * @return \Illuminate\Http\JsonResponse
     * @author  Bob<bob@bobcoder.cc>
     */
    public function adverts(Request $request, Advert $advert)
    {
        $position_id = (int)$request->query('position_id', 1);

        $result = $advert->where('position_id', $position_id)->orderBy('sort', 'desc')->get();

        return response()->json($result, 200);
    }

    /**
     * 标签
     * @param Tag $tag
     * @return \Illuminate\Http\JsonResponse
     * @author  Bob<bob@bobcoder.cc>
     */
    public function tag(Tag $tag)
    {
        $result = $tag->orderBy('sort', 'desc')->orderBy('created_at', 'desc')->get();

        return response()->json($result, 200);
    }

    /**
     * 友情链接
     * @param Links $links
     * @return \Illuminate\Http\JsonResponse
     * @author   Bob<bob@bobcoder.cc>
     */
    public function links(Links $links)
    {
        $result = $links->where('status', 1)->orderBy('sort', 'desc')->orderBy('created_at', 'desc')->get();

        return response()->json($result, 200);
    }

    /**
     * 站点基本信息
     * @return \Illuminate\Http\JsonResponse
     * @author   Bob<bob@bobcoder.cc>
     */
    public function site()
    {
        $data = Site::query()->get();
        $object = (object)[];

        foreach ($data as $res) {
            $object->{$res->key} = $res->value;
        }

        return response()->json($object, 200);
    }


}
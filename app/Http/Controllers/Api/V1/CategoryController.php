<?php
/**
 * @Author Bob
 * Date: 2019/3/26
 * @Email  bob@bobcoder.cc
 * @Site https://www.bobcoder.cc/
 */

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    /**
     * 获取菜单分类
     * @param Request $request
     * @param Category $category
     * @return \Illuminate\Http\JsonResponse
     * @author  Bob<bob@bobcoder.cc>
     */
    public function index(Request $request, Category $category)
    {
        $parent_id = $request->get('parent_id',0);
        $categories = $category->where('parent_id', $parent_id)
                ->orderBy('id','desc')
                ->orderBy('sort','desc')
                ->get();

        return response()->json($categories)->setStatusCode(200);
    }
}
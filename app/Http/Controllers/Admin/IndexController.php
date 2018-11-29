<?php

namespace App\Http\Controllers\Admin;

use App\Models\Area;
use App\Models\Article;
use App\Models\Icon;
use App\Models\Member;
use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use App\Models\VisitLog;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class IndexController extends Controller
{
    /**
     * 后台布局
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function layout()
    {
        return view('admin.layout');
    }

    /**
     * 后台首页
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('admin.index.index');
    }
    public function index1()
    {
        return view('admin.index.index1');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @author   Bob<bob@bobcoder.cc>
     */
    public function index2()
    {
        //文章总数
        $articles_all = Article::query()->count('id');
        //当月文章总数
        $articles_month = Article::query()->whereMonth('created_at',Carbon::now()->month)->count('id');
        //访客总数
        $visit_all = VisitLog::query()->distinct()->count('ip');
        //当月访客总数
        $visit_month = VisitLog::query()->whereMonth('created_at',Carbon::now()->month)->distinct()->count('ip');
        //用户总数
        $members_all = Member::query()->count('id');
        //当月用户新增总数
        $members_month = Member::query()->whereMonth('created_at',Carbon::now()->month)->count('id');

        $articles = Article::query()
            ->with('tags')
            ->select('id','title','created_at','content')
            ->limit(10)
            ->orderBy('created_at','desc')
            ->get();

        $area = Area::query()->select('name','value')->orderBy('value','desc')->limit(8)->get();

        $data = [
            'articles_all'=>$articles_all,
            'articles_month'=>$articles_month,
            'visit_all'=>$visit_all,
            'visit_month'=>$visit_month,
            'members_all'=>$members_all,
            'members_month'=>$members_month
            ];

        return view('admin.index.index2',['data'=>$data,'articles'=>$articles,'area'=>$area]);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     * @author   Bob<bob@bobcoder.cc>
     */
    public function area()
    {
        $data = Area::query()->select('name','value')->get();

        return response()->json($data,200);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * 数据表格接口
     */
    public function data(Request $request)
    {
        $model = $request->get('model');
        switch (strtolower($model)) {
            case 'user':
                $query = new User();
                break;
            case 'role':
                $query = new Role();
                break;
            case 'permission':
                $query = new Permission();
                $query = $query->where('parent_id', $request->get('parent_id', 0))->with('icon');
                break;
            default:
                $query = new User();
                break;
        }
        $res = $query->paginate($request->get('limit', 30))->toArray();
        $data = [
            'code' => 0,
            'msg' => '正在请求中...',
            'count' => $res['total'],
            'data' => $res['data']
        ];
        return response()->json($data);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     * 所有icon图标
     */
    public function icons()
    {
        $icons = Icon::orderBy('sort', 'desc')->get();
        return response()->json(['code' => 0, 'msg' => '请求成功', 'data' => $icons]);
    }

}

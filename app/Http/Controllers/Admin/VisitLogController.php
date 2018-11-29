<?php

namespace App\Http\Controllers\Admin;

use App\Models\ShieldIp;
use App\Models\VisitLog;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class VisitLogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.visit.index');
    }

    public function data(Request $request)
    {
        $model = VisitLog::query();
        $field = (string)$request->get('field','');
        $keyword = (string)$request->get('keyword','');
        $limit = (int)$request->get('limit',30);

        if($field && $keyword){
            $model->where($field,'like','%'.$keyword.'%');
        }

        $res = $model
            ->orderBy('id','desc')
            ->paginate($limit)
            ->toArray();

        $data = [
            'code' => 0,
            'msg'   => '正在请求中...',
            'count' => $res['total'],
            'data'  => $res['data']
        ];

        return response()->json($data);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @author   Bob<bob@bobcoder.cc>
     */
    public function shield(Request $request)
    {
        $res = ShieldIp::query()
            ->orderBy('id','desc')
            ->paginate($request->get('limit',30))
            ->toArray();

        $data = [
            'code' => 0,
            'msg'   => '正在请求中...',
            'count' => $res['total'],
            'data'  => $res['data']
        ];

        return response()->json($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.visit.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $shield = new ShieldIp();
        $shield->ip = $request->input('ip');
        $shield->remark = $request->input('remark');

        if ($shield->save()){
            return redirect(route('admin.visit'))->with(['status'=>'添加完成']);
        }

        return redirect(route('admin.visit'))->with(['status'=>'系统错误']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $ids = $request->get('ids');
        if (empty($ids)){
            return response()->json(['code'=>1,'msg'=>'请选择删除项']);
        }
        if (VisitLog::destroy($ids)){
            return response()->json(['code'=>0,'msg'=>'删除成功']);
        }

        return response()->json(['code'=>1,'msg'=>'删除失败']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function del(Request $request)
    {
        $ids = $request->get('ids');
        if (empty($ids)){
            return response()->json(['code'=>1,'msg'=>'请选择删除项']);
        }
        if (ShieldIp::destroy($ids)){
            return response()->json(['code'=>0,'msg'=>'删除成功']);
        }

        return response()->json(['code'=>1,'msg'=>'删除失败']);
    }
}

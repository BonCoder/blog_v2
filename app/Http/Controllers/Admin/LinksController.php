<?php

namespace App\Http\Controllers\Admin;

use App\Models\Links;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use phpDocumentor\Reflection\DocBlock\Tags\Link;

class LinksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.links.index');
    }

    public function data(Request $request)
    {
        $model = Links::query();
        $field = (string)$request->get('field','');
        $keyword = (string)$request->get('keyword','');
        $limit = (int)$request->get('limit',30);

        if($field && $keyword){
            $model->where($field,'like','%'.$keyword.'%');
        }

        $res = $model->orderBy('id','desc')->orderBy('sort','desc')->paginate($limit)->toArray();
        
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
        return view('admin.links.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'name'  => 'required|string',
            'link'  => 'required|string',
            'sort'  => 'numeric'
        ]);

        $link = new Links();
        $link->name = $request->input('name');
        $link->link = $request->input('link');
        $link->email = $request->input('email');
        $link->sort = $request->input('sort');

        if ($link->save()){
            return redirect(route('admin.links'))->with(['status'=>'添加完成']);
        }
        return redirect(route('admin.links'))->with(['status'=>'系统错误']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $links = Links::findOrFail($id);
        return view('admin.links.edit',compact('links'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'name'  => 'required|string',
            'link'  => 'required|string',
            'email'  => 'required|string',
            'sort'  => 'required|numeric'
        ]);
        $links = Links::findOrFail($id);
        if ($links->update($request->only(['name','link','email','sort']))){
            return redirect(route('admin.links'))->with(['status'=>'更新成功']);
        }
        return redirect(route('admin.links'))->withErrors(['status'=>'系统错误']);
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
        if (Links::destroy($ids)){
            return response()->json(['code'=>0,'msg'=>'删除成功']);
        }
        return response()->json(['code'=>1,'msg'=>'删除失败']);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @author   Bob<bob@bobcoder.cc>
     */
    public function status(Request $request)
    {
        $id = (int)$request->post('id');
        $links = Links::findOrFail($id);
        $links->status = $links->status == 1 ? 0 : 1;
        $links->save();

        return response()->json(['code'=>1,'msg'=>'修改成功'],200);
    }
}

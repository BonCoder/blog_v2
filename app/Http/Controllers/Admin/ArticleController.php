<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ArticleRequest;
use App\Models\Article;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //分类
        $categorys = Category::with('allChilds')->where('parent_id',0)->orderBy('sort','desc')->get();
        return view('admin.article.index',compact('categorys'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @author   Bob<bob@bobcoder.cc>
     */
    public function data(Request $request)
    {
        $article = new Article();
        $category_id = (int)$request->get('category_id','');
        $title = (string)$request->get('title','');
        $limit = (int)$request->get('limit',30);

        $res = $article
            ->with(['tags','category'])
            ->when($title,function ($query) use ($title){
                $query->where('title','like','%'.$title.'%');
            })
            ->when($category_id,function ($query) use ($category_id){
                $query->where('category_id',$category_id);
            })
            ->orderBy('created_at','desc')
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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     * @author   Bob<bob@bobcoder.cc>
     */
    public function create()
    {
        //分类
        $categorys = Category::with('allChilds')->where('parent_id',0)->orderBy('sort','desc')->get();
        //标签
        $tags = Tag::get();
        return view('admin.article.create',compact('tags','categorys'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ArticleRequest $request
     * @return \Illuminate\Http\Response
     * @author   Bob<bob@bobcoder.cc>
     */
    public function store(ArticleRequest $request)
    {
        $data = $request->only(['category_id','title','keywords','content','thumb','click']);
        $article = Article::create($data);
        if ($article && !empty($request->get('tags')) ){
            $article->tags()->sync($request->get('tags'));
        }
        return redirect(route('admin.article'))->with(['status'=>'添加成功']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return void
     * @author   Bob<bob@bobcoder.cc>
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
     * @author   Bob<bob@bobcoder.cc>
     */
    public function edit($id)
    {
        $article = Article::with('tags')->findOrFail($id);
        if (!$article){
            return redirect(route('admin.article'))->withErrors(['status'=>'文章不存在']);
        }
        //分类
        $categorys = Category::with('allChilds')->where('parent_id',0)->orderBy('sort','desc')->get();
        //标签
        $tags = Tag::get();
        foreach ($tags as $tag){
            $tag->checked = $article->tags->contains($tag) ? 'checked' : '';
        }
        return view('admin.article.edit',compact('article','categorys','tags'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param ArticleRequest $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     * @author   Bob<bob@bobcoder.cc>
     */
    public function update(ArticleRequest $request, $id)
    {
        $article = Article::with('tags')->findOrFail($id);
        $data = $request->only(['category_id','title','keywords','content','thumb','click']);
        if ($article->update($data)){
            $article->tags()->sync($request->get('tags',[]));
            return redirect(route('admin.article'))->with(['status'=>'更新成功']);
        }
        return redirect(route('admin.article'))->withErrors(['status'=>'系统错误']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     * @author   Bob<bob@bobcoder.cc>
     */
    public function destroy(Request $request)
    {
        $ids = $request->get('ids');
        if (empty($ids)){
            return response()->json(['code'=>1,'msg'=>'请选择删除项']);
        }
        foreach (Article::whereIn('id',$ids)->get() as $model){
            //清除中间表数据
            $model->tags()->sync([]);
            //删除文章
            $model->delete();
        }
        return response()->json(['code'=>0,'msg'=>'删除成功']);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @author   Bob<bob@bobcoder.cc>
     */
    public function status(Request $request)
    {
        $id = (int)$request->input('id');
        $field = $request->input('field');

        $article = Article::find($id);
        $article->$field = $article->$field == 1 ? 0 : 1 ;
        $article->save();

        return response()->json(['code'=>1,'msg'=>'更新成功']);
    }
}

<?php
/**
 * @Author Bob
 * @Date: 2018/12/3
 * @Email  bob@bobcoder.cc
 * @Site https://www.bobcoder.cc/
 */
namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Member;
use App\Models\User;
use App\Traits\PushMessage;
use Illuminate\Http\Request;
use Illuminate\Contracts\Cache\Repository as ContractsCacheRepository;
use App\Models\Comments as CommentsModel;

class CommentsController extends Controller
{
    use PushMessage;

    protected $cache;

    /**
     * Create the repository instance.
     *
     * @param \Illuminate\Contracts\Cache\Repository $cache
     */
    public function __construct(ContractsCacheRepository $cache)
    {
        $this->cache = $cache;
    }

    /**
     * @param Request $request
     * @param Article $article
     * @return \Illuminate\Http\JsonResponse
     * @author   Bob<bob@bobcoder.cc>
     */
    public function index(Request $request, Article $article)
    {
        $limit = $request->input('limit', 15);
        $offset = $request->input('offset', 0);

        $comments = $article->comments()
            ->with(['user','reply'])
            ->limit($limit)
            ->offset($offset)
            ->orderBy('created_at','desc')
            ->get();

        return response()->json($comments,200);
    }

    /**
     * @param Request $request
     * @param Article $article
     * @param CommentsModel $comment
     * @return \Illuminate\Http\JsonResponse
     * @author   Bob<bob@bobcoder.cc>
     */
    public function store(Request $request, Article $article, CommentsModel $comment)
    {
        $user = $request->user();
        $article = $article->first();
        //判断是否存在缓存
        $key = $article->id . 'article_comment' . $user->id;
        if ($this->cache->get($key)) {
            return response()->json(['message' => '请勿频繁评论'], 422);
        }
        $content = $request->input('content');
        $replyUser = (int) $request->input('reply_user', 0);
        $parent_id = (int) $request->input('parent_id', 0);
        if (! $content) {
            return response()->json(['message' => '请输入评论内容'], 422);
        }
        $comment->user_id = $user->id;
        $comment->reply_user = $replyUser;
        $comment->target_user = $article->user_id;
        $comment->parent_id = $parent_id;
        $comment->content = $content;
        $article->comments()->save($comment);
        $article->increment('comment_count',1);
        //判断接收者
        if(! $replyUser){
            $this->pushMessage($article->title,$user->name,$content,$user->uuid,User::find($article->user_id)->uuid,32);
        }else{
            $this->pushMessage($article->title,$user->name,$content,$user->uuid,Member::find($replyUser)->uuid,33);
        }
        //添加缓存
        $this->cache->put($key, $article->id,1);

        return response()->json(['code'=>1,'message'=>'评论成功','comment'=>$comment])->setStatusCode(201);
    }

    /**
     * 推送消息
     *
     * @param $title
     * @param $username
     * @param $content
     * @param $send_uuid
     * @param $accept_uuid
     * @param $flag
     * @author   Bob<bob@bobcoder.cc>
     */
    protected function pushMessage($title, $username, $content, $send_uuid, $accept_uuid, $flag)
    {
        $this->push([
            'title' => '文章《' . $title . '》被评论',
            'content' => '用户:' . $username . '评论了您的文章《'. $title .'》,内容为：“'.$content.'”',
            'send_uuid' => $send_uuid,
            'accept_uuid' => $accept_uuid ,
            'flag' => $flag
        ]);
    }




}
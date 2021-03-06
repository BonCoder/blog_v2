<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property mixed id
 */
class Article extends Model
{
    use SoftDeletes;

    protected $table = 'articles';

    protected $primaryKey = 'id';

    protected $fillable = ['category_id', 'title', 'keywords', 'content', 'thumb', 'click', 'recommend', 'user_id'];

    protected $hidden = ['commentable_type', 'commentable_id'];

//    protected $with = ['category', 'tags'];

    /**
     *  文章所属分类
     */
    public function category()
    {
        return $this->belongsTo('App\Models\Category');
    }

    /**
     *  与标签多对多关联
     */
    public function tags()
    {
        return $this->belongsToMany('App\Models\Tag', 'article_tag', 'article_id', 'tag_id');
    }

    /**
     *  文章对应的评论.
     */
    public function comments()
    {
        return $this->morphMany(Comments::class, 'commentable');
    }

    /**
     *  文章转载地址
     */
    public function source(): HasOne
    {
        return $this->hasOne(Source::class, 'article_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     * @author   Bob<bob@bobcoder.cc>
     * @link https://www.bobcoder.cc/
     * @Date  2019/11/29
     */
    public function user()
    {
        return $this->belongsTo(User::class)->select('id', 'username', 'avatar', 'introduction');
    }
}

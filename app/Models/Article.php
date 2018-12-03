<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property mixed id
 */
class Article extends Model
{
    protected $table = 'articles';

    protected $fillable = ['category_id','title','keywords','content','thumb','click','recommend','user_id'];

    protected $hidden = ['commentable_type', 'commentable_id'];

    protected $with = ['category', 'tags'];

    //文章所属分类
    public function category()
    {
        return $this->belongsTo('App\Models\Category');
    }

    //与标签多对多关联
    public function tags()
    {
        return $this->belongsToMany('App\Models\Tag','article_tag','article_id','tag_id');
    }

    /**
     *  文章对应的评论.
     */
    public function comments()
    {
        return $this->morphMany(Comments::class, 'commentable');
    }

}

<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Source extends Model
{
    protected $table = 'source';

    protected $primaryKey = 'article_id';

    public $incrementing = false;

    protected $fillable = ['article_id', 'link'];

    protected $hidden = ['created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     * @author   Bob<bob@bobcoder.cc>
     */
    public function article()
    {
        return $this->belongsTo(Article::class);
    }
}
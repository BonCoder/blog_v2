<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comments extends Model
{
    protected $table = 'comments';

    protected $primaryKey = 'id';

    /**
     * Has commentable.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     * @author Bob<bob@bobcoder.cc>
     */
    public function commentable()
    {
        return $this->morphTo('commentable');
    }

    /**
     * Has a user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     * @author Bob<bob@bobcoder.cc>
     */
    public function user()
    {
        return $this->belongsTo(Member::class, 'user_id', 'id');
    }

    /**
     * 被回复者.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     * @author   Bob<bob@bobcoder.cc>
     */
    public function target()
    {
        return $this->belongsTo(Member::class, 'target_user', 'id');
    }

    /**
     * 被回复者.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     * @author   Bob<bob@bobcoder.cc>
     */
    public function reply()
    {
        return $this->belongsTo(Member::class, 'reply_user', 'id');
    }

}

<?php

namespace Modules\Post\Entities;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [
        'post_id',
        'user_id',
        'comment',
        'comment_id',
    ];

    public function user(){
        return $this->belongsTo('Modules\User\Entities\User');
    }
    public function post(){
        return $this->belongsTo('Modules\Post\Entities\Post');
    }

    public function comment()
    {
        return $this->belongsToOne(Comment::class, 'comment_id')->whereNull('comment_id');
    }

    public function reply()
    {
        return $this->hasMany(Comment::class, 'comment_id');
    }
}

<?php

namespace Modules\Post\Entities;

use App\NewsItemFeed;
use Illuminate\Database\Eloquent\Model;
use Spatie\Feed\Feedable;
use Spatie\Feed\FeedItem;

class Post extends Model implements Feedable
{
    protected $fillable = [];

    public function image(){
        //   return $this->hasOne(Media::class ,'id', 'avatar_id');
        return $this->belongsTo('Modules\Gallery\Entities\Image');
    }
    public function videoThumbnail(){
        return $this->belongsTo('Modules\Gallery\Entities\Image', 'video_thumbnail_id','id');
    }
    public function video(){
        return $this->belongsTo('Modules\Gallery\Entities\Video', 'video_id','id');
    }

    public function category(){
        return $this->belongsTo('Modules\Post\Entities\Category');
    }
    public function subCategory(){
        return $this->belongsTo('Modules\Post\Entities\SubCategory');
    }
    public function user(){
        return $this->belongsTo('Modules\User\Entities\User');
    }
    public function comments()
    {
        return $this->hasMany('Modules\Post\Entities\Comment');
    }

    public function replay()
    {
        return $this->hasMany('Modules\Post\Entities\Comment', 'comment_id')->where('comment_id',null)->with('replay');
    }

    public function toFeedItem(): FeedItem
    {

        return FeedItem::create([
            'id'        => $this->id,
            'title'     => $this->title,
            'summary'   => @$this->image->medium_image,
            'updated'   => $this->updated_at,
            'link'      =>route('article.detail', ['id' => $this->slug]),
            'author'    => $this->user->first_name,
        ]);
    }

    public static function getFeedItems()
    {
        return Post::with(['category','image'])
            ->where('visibility', 1)
            ->where('status',1)
            ->whereNotNull('image_id')
            ->orderBY('id', 'desc')
            ->limit(10)->get();
    }
}

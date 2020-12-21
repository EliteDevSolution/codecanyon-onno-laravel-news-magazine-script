<?php

namespace Modules\Api\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Config;
use Validator;
use Modules\Post\Entities\Post;
use App\Traits\ApiReturnFormat;

class PostController extends Controller
{
    use ApiReturnFormat;

    public function searchPost(Request $request){

        $validator = Validator::make($request->all(), [
            'search' => 'required',
        ]);

        if($validator->fails()){
           return $this->responseWithError('Invalid Credentials', $validator->errors(), 422);
        }
        $language = Config::get('app.locale');

        $posts = Post::with('image','video','category:id,category_name','user:id,first_name,last_name,email')
                    ->Where('title', 'like', '%' . $request->search . '%')
                    ->where('status',1)
                    ->where('language',$language)
                    ->select('id','category_id','user_id','image_id','video_id','title','slug','content','created_at')
                    ->orderBy('slider_order')
                    ->paginate(15);

        return $this->responseWithSuccess('Successfully data found',$posts);

    }
    public function postDetails($slug){
        $language = Config::get('app.locale');

        $post = Post::with(['image','video','category:id,category_name','user:id,first_name,last_name,email',
                'comments' => function($q){
                            $q->select('id','post_id','user_id','comment_id','comment','status');
                            $q->where('status',1);
                            $q->where('comment_id',null);
                        },
                'comments.replay' => function($q){
                            $q->select('id','post_id','user_id','comment_id','comment','status');
                            $q->where('status',1);
                        },
                'comments.user:id,first_name,last_name,email,image_id',
                'comments.replay.user:id,first_name,last_name,email,image_id',
                'comments.user.image'
                ])
                    ->Where('slug', $slug)
                    ->where('status',1)
                    ->where('language',$language)
                    // ->select('id','category_id','user_id','image_id','video_id','title','slug','content','tags','created_at')
                    ->first();

            $categoryId = $post->category_id;
            $related_post = Post::where('category_id', $categoryId)
                    ->with('image','video','category:id,category_name','user:id,first_name,last_name,email')
                    ->where('status',1)
                    ->where('language',$language)
                    ->select('id','category_id','user_id','image_id','video_id','title','slug','content','created_at')
                    ->orderBy('created_at','DESC')
                    ->take(8)
                    ->get();

            $detailsPage['post_details'] = $post;
            $detailsPage['related_post'] = $related_post;

        return $this->responseWithSuccess('Successfully data found',$detailsPage);
    }
}

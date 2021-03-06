<div class="entry-header">
    <div class="entry-thumbnail">
        <a href="{{ route('article.detail', ['id' => $post->slug]) }}">
            @if(isFileExist($post->image, @$post->image->small_image))
                <img src=" {{basePath($post->image)}}/{{ $post->image->small_image }} " class="img-fluid"   alt="{!! $post->title !!}"  >
            @else
                <img src="{{static_asset('default-image/default-100x100.png') }} "  class="img-fluid"   alt="{!! $post->title !!}" >
            @endif
        </a>
    </div>
    @if($post->post_type=="video")
        <div class="video-icon-catagory">
            <i class="fa fa-play" aria-hidden="true"></i>
        </div>
    @endif

</div>

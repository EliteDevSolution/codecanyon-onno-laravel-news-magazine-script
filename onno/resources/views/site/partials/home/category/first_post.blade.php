<div class="entry-header">
    <div class="entry-thumbnail">
        <a href="{{ route('article.detail', ['id' => @$firstPost->slug]) }}">
            @if(isFileExist($firstPost->image, @$firstPost->image->medium_image))
                <img src=" {{basePath($firstPost->image)}}/{{ $firstPost->image->medium_image }} " class="img-fluid"   alt="{!! $firstPost->title !!}"  >
            @else
                <img src="{{static_asset('default-image/default-358x215.png') }} "  class="img-fluid"   alt="{!! $firstPost->title !!}" >
            @endif
        </a>
    </div>
    @if($firstPost->post_type=="video")
        <div class="video-icon">
            <i class="fa fa-play" aria-hidden="true"></i>
        </div>
    @endif
</div>

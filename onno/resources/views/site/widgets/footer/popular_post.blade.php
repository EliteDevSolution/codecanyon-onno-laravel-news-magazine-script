<div class="col-lg-4">
    <div class="footer-widget">
        <h3>{{ data_get($detail, 'title') }}</h3>
        @foreach($content as $post)
            @if($loop->index > 2)
                @break
            @endif

            @if(data_get(activeTheme(), 'options.footer_style') == 'footer_1')
            <div class="sg-post small-post post-style-1">
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
                        <div class="video-icon-catagory-footer">
                            <i class="fa fa-play" aria-hidden="true"></i>
                        </div>
                    @endif

                </div>

                <div class="entry-content">
                    <h2 class="entry-title"><a href="{{ route('article.detail', [$post->slug]) }}">{{ \Illuminate\Support\Str::limit(data_get($post, 'title'), 50) }}</a></h2>
                    <div class="entry-meta">
                        <ul class="global-list">
                            <li>{{ __('post_by') }} {{ data_get($post, 'user.first_name') }} {{ $post->updated_at->format('F j, Y') }}</li>
                        </ul>
                    </div>
                </div>
            </div>

            @elseif(data_get(activeTheme(), 'options.footer_style') == 'footer_2')
                <div class="sg-post small-post">

                    <div class="entry-content p-0">
                        <h2 class="entry-title"><a href="{{ route('article.detail', [$post->slug]) }}">{{ \Illuminate\Support\Str::limit(data_get($post, 'title'), 50) }}</a></h2>
                        <div class="entry-meta">
                            <ul class="global-list">
                                <li>{{ __('post_by') }} {{ data_get($post, 'user.first_name') }} {{ $post->updated_at->format('F j, Y') }}</li>
                            </ul>
                        </div>
                    </div>
                </div>
            @endif
        @endforeach
    </div>
</div>

@php
    $blockPosts = $posts->take(4);
@endphp

<div class="sg-breaking-news">
    <div class="container">
        <div class="breaking-content d-flex">
            <span>{{ __('breaking_news') }}</span>
            <ul class="news-ticker">
                @foreach($breakingNewss as $post)
                    <li id="display-nothing">
                        <a href="{{ route('article.detail', ['id' => $post->slug]) }}">{!! \Illuminate\Support\Str::limit($post->title, 100) !!}</a>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>

<div class="sg-home-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="post-slider">
                    @foreach($sliderPosts as $post)
                        <div class="sg-post featured-post">
                            @include('site.partials.home.primary.slider')
                            <div class="entry-content absolute">
                                <div class="category">
                                    <ul class="global-list">
                                        @isset($post->category->category_name)
                                        <li><a href="javascript:void(0)">{{ $post->category->category_name }}</a></li>
                                        @endisset
                                    </ul>
                                </div>
                                <h2 class="entry-title">
                                    <a href="{{ route('article.detail', ['id' => $post->slug]) }}">{!! \Illuminate\Support\Str::limit($post->title, 50) !!}</a>
                                </h2>
                                <div class="entry-meta">
                                    <ul class="global-list">
                                        <li>{{ __('post_by') }} <a href="javascript:void(0)">{{ data_get($post, 'user.first_name') }}</a></li>
                                        <li><a href="javascript:void(0)">{{ $post->updated_at->format('F j, Y') }}</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="col-lg-6">
                <div class="row">
                   {{--  @php dd($blockPosts); @endphp --}}
                    @foreach($blockPosts as $post)
                        <div class="col-md-6">
                            <div class="sg-post">
                                <div class="entry-header">
                                    <div class="entry-thumbnail">
                                        <a href="{{ route('article.detail', ['id' => $post->slug]) }}">
                                            @if(isFileExist(@$post->image, @$post->image->medium_image))
                                                <img src=" {{basePath(@$post->image)}}/{{ @$post->image->medium_image }} "  class="img-fluid"   alt="{!! $post->title !!}" >
                                            @else
                                                <img src="{{static_asset('default-image/default-358x215.png') }} "  class="img-fluid"   alt="{!! $post->title !!}" >
                                            @endif
                                        </a>
                                    </div>
                                    @if($post->post_type=="video")
                                        <div class="video-icon-catagory-slider">
                                            <i class="fa fa-play" aria-hidden="true"></i>
                                        </div>
                                    @endif
                                    <div class="category">
                                        <ul class="global-list">
                                            @isset($post->category->category_name)
                                            <li><a href="javascript:void(0)">{{ $post->category->category_name }}</a></li>
                                            @endisset
                                        </ul>
                                    </div>
                                </div>
                                <div class="entry-content">
                                    <a href="{{ route('article.detail', ['id' => $post->slug]) }}"><p>{!! \Illuminate\Support\Str::limit($post->title, 50) !!}</p></a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>



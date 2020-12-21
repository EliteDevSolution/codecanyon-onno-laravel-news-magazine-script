@extends('site.layouts.app')
@section('style')
    <link rel="stylesheet" href="{{ static_asset('site/css/plyr.css') }}" />
@endsection
@section('content')

    <div class="sg-page-content">
        <div class="container">
            <div class="row">
                <div class="col-md-7 col-lg-8 sg-sticky">
                    <div class="theiaStickySidebar post-details">
                        <div class="sg-section">
                            <div class="section-content">
                                <div class="sg-post">
                                    <div class="entry-header">
                                        <div class="entry-thumbnail" height="100%">

                                            @if($post->post_type=='video')
                                                @if($post->video_id != null)


                                                    @if(isFileExist(@$post->videoThumbnail, @$post->videoThumbnail->big_image_two))


                                                    <video id='player' autoplay controls poster="{{basePath($post->videoThumbnail)}}/{{ $post->videoThumbnail->big_image_two }} " height="100%">
                                                        @else
                                                            <video id='player' autoplay controls poster="{{static_asset('default-image/default-730x400.png') }}" height="100%">
                                                        @endif
                                                        {{--                                                            $this->video->get_all_videos($id);--}}
                                                        @if($post->video->v_144p==null and
                                                            $post->video->v_240p==null and
                                                            $post->video->v_360p==null and
                                                            $post->video->v_480p==null and
                                                            $post->video->v_720p==null and
                                                            $post->video->v_1080p==null
                                                        )
                                                            <source src="{{ basePath($post->video) }}/{{ $post->video->original }}" type="video/{{$post->video->video_type}}" />

                                                        @else
                                                            <?php $video_version = array( 'v_1080p','v_720p','v_480p','v_360p','v_240p','v_144p') ?>

                                                            @foreach($video_version as $version)
                                                                @if($post->video->$version !=null)
                                                                    <source src="{{ basePath($post->video) }}/{{ $post->video->$version }}" size="{{ str_replace("v_","",$version) }}" type="video/{{$post->video->video_type}}" />
                                                                @endif
                                                            @endforeach
                                                        @endif
                                                    </video>

                                                @else
                                                    @if($post->video_url_type == "youtube_url")
                                                        <div id="player" autoplay data-plyr-provider="youtube" data-plyr-embed-id="{{get_id_youtube($post->video_url)}}" height="100%"></div>
                                                    @elseif($post->video_url_type == "mp4_url")

                                                        <video id="player" autoplay playsinline controls data-poster="{{ basePath(@$post->image)}}/{{ @$post->image->big_image_two }}" height="100%">
                                                            <source src="{{$post->video_url}}" type="video/mp4"/>

                                                        </video>
                                                    @else
                                                        <img class="img-fluid" src="{{static_asset('default-image/default-730x400.png') }} "   alt="{!! $post->title !!}">
                                                    @endif
                                                @endif
                                            @else
                                                @if(isFileExist(@$post->image, @$post->image->big_image_two))
                                                    <img class="img-fluid" src="{{ basePath(@$post->image) }}/{{ @$post->image->big_image_two }}" alt="{!! $post->title !!}">
                                                @else
                                                    <img class="img-fluid" src="{{static_asset('default-image/default-730x400.png') }} "   alt="{!! $post->title !!}">
                                                @endif

                                            @endif
                                        </div>
                                    </div>

                                    <div class="entry-content p-4">
                                        <h3 class="entry-title">{!! $post->title ?? '' !!}</h3>
                                        <div class="entry-meta mb-2">
                                            <ul class="global-list">
                                                <li><i class="fa fa-calendar-minus-o" aria-hidden="true"></i>
                                                    <a href="#">{{ $post->updated_at->format('F j, Y') }}</a>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="paragraph">
                                            {!! $post->content !!}
                                        </div>
                                        @if(settingHelper('adthis_option')==1 and settingHelper('addthis_public_id')!=null)
                                            <div class="addthis_inline_share_toolbox" ></div>
                                        @endif
                                    </div>
                                </div>

                                @if($post->tags!=null)
                                    <div class="sg-section mb-4">
                                        <div class="section-content">
                                            <div class="section-title">
                                                <h1>{{ __('tags') }}</h1>
                                            </div>

                                            <div class="tagcloud tagcloud-style-1">
                                                @if(!blank($tags = explode(',', $post->tags)))
                                                    @foreach($tags as $tag)
                                                        <a href="{{ url('tags/'.$tag) }}">{{ $tag }}</a>
                                                    @endforeach
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                @endif

                                @if(settingHelper('inbuild_comment') == 1)
                                    <div class="sg-section">
                                        <div class="section-content">
                                            <div class="section-title">
                                                <h1>{{ __('comment') }} / {{ __('reply_from') }}</h1>
                                            </div>
                                            <form class="contact-form" name="contact-form" method="post" action="{{ route('article.save.comment') }}">
                                                @csrf
                                                <input type="hidden" name="post_id" value="{{ $post->id }}">
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <div class="form-group">
                                                            <label for="four">{{ __('comments') }}</label>
                                                            <textarea name="comment" required="required"
                                                                      class="form-control" rows="7" id="four"
                                                                      placeholder="this is message..."></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    @if(Cartalyst\Sentinel\Laravel\Facades\Sentinel::check())
                                                        <button type="submit" class="btn btn-primary">{{ __('post') }} {{ __('comment') }}</button>
                                                    @else
                                                        <a class="btn btn-primary" href="{{ route('site.login.form') }}">{{ __('comment') }}</a>
                                                    @endif
                                                </div>
                                            </form>
                                        </div>
                                    </div>

                                    @if(!blank($comments = data_get($post, 'comments')))
                                        <div class="sg-section">
                                            <div class="section-content">
                                                <div class="sg-comments-area">
                                                    <div class="section-title">
                                                        <h1>{{ __('comments') }}</h1>
                                                    </div>
                                                        @include('site.post.comment', ["comments" => $comments])
                                                </div>
                                            </div>
                                        </div>
                                    @endif

                                @endif

                                @if(settingHelper('facebook_comment')==1)
                                    <div class="fb-comments" data-href="{{ url()->current() }}" data-numposts="5" data-width="100%"></div>
                                @endif

                                @if(settingHelper('disqus_comment')==1)
                                <!-- disqus comments -->
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div id="disqus_thread"></div>
                                            <script>
                                                var disqus_config = function () {
                                                    this.page.url = "{{ url()->current() }}";  // Replace PAGE_URL with your page's canonical URL variable
                                                    this.page.identifier = "{{ $post->id }}"; // Replace PAGE_IDENTIFIER with your page's unique identifier variable
                                                };

                                                (function() { // DON'T EDIT BELOW THIS LINE
                                                    var d = document, s = d.createElement('script');
                                                    s.src = 'https://{{ settingHelper('disqus_short_name') }}.disqus.com/embed.js';
                                                    s.setAttribute('data-timestamp', +new Date());
                                                    (d.head || d.body).appendChild(s);
                                                })();
                                            </script>
                                            <noscript><a href="https://disqus.com/?ref_noscript"></a></noscript>
                                            <script id="dsq-count-scr" src="//{{ settingHelper('disqus_short_name') }}.disqus.com/count.js" async></script>
                                        </div>
                                    </div>
                                    <!-- END disqus comments -->
                                @endif


                                @if(!blank($relatedPost))
                                    <div class="sg-section">
                                        <div class="section-content">
                                            <div class="section-title">
                                                <h1>{{ __('related_post') }}</h1>
                                            </div>
                                            <div class="row text-center">
                                                @foreach($relatedPost as $item)
                                                    <div class="col-lg-6">
                                                        <div class="sg-post post-style-2">
                                                            <div class="entry-header">
                                                                <div class="entry-thumbnail">
                                                                    <a href="{{ route('article.detail', [$item->slug]) }}">
                                                                         @if(isFileExist(@$item->image, @$item->image->medium_image))
                                                                            <img src="{{ basePath(@$item->image) }}/{{ @$item->image->medium_image }}" class="img-fluid" {!! $item->title !!}>
                                                                        @else
                                                                            <img class="img-fluid" src="{{static_asset('default-image/default-358x215.png') }} "  {!! $item->title !!}>
                                                                        @endif
                                                                    </a>
                                                                </div>
                                                                <div class="video-icon">
                                                                    <i class="fa fa-play" aria-hidden="true"></i>
                                                                </div>
                                                            </div>
                                                            <div class="entry-content">
                                                                <h3 class="entry-title"><a href="{{ route('article.detail', [$item->slug]) }}">{!! $item->title ?? '' !!}</a></h3>
{{--                                                                <p>{!! \Illuminate\Support\Str::limit($item->content ?? '', 40) !!}</p>--}}
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-5 col-lg-4 sg-sticky">
                    <div class="sg-sidebar theiaStickySidebar">
                        @include('site.partials.right_sidebar_widgets')
                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection

@section('script')
@if($post->post_type =='video')
<script src="{{static_asset('site/js') }}/plyr.js"></script>
<script src="{{static_asset('site/js') }}/plyr_ini.js"></script>
@endif

@endsection

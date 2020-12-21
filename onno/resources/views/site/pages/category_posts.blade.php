@extends('site.layouts.app')

@section('content')
    <div class="sg-main-content mb-4">
        <div class="container">
            <div class="row">
                <div class="col-md-7 col-lg-8 sg-sticky">
                    <div class="theiaStickySidebar">
                        @foreach($posts as $post)
                            <div class="sg-section">
                                <div class="section-content">
                                    <div class="sg-post medium-post-style-1">
                                        <div class="entry-header">
                                            <div class="entry-thumbnail">
                                                <a href="{{ route('article.detail', ['id' => $post->slug]) }}">
                                                    @if(isFileExist($post->image, @$post->image->medium_image))
                                                        <img src=" {{basePath($post->image)}}/{{ $post->image->medium_image }} " class="img-fluid"   alt="{!! $post->title !!}"  >
                                                    @else
                                                        <img src="{{static_asset('default-image/default-358x215.png') }} "  class="img-fluid"   alt="{!! $post->title !!}" >
                                                    @endif
                                                </a>
                                            </div>
                                            @if($post->post_type=="video")
                                                <div class="video-icon">
                                                    <i class="fa fa-play" aria-hidden="true"></i>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="entry-content align-self-center">
                                            <h3 class="entry-title"><a
                                                    href="{{ route('article.detail', ['id' => $post->slug]) }}">{!! \Illuminate\Support\Str::limit($post->title, 65) !!}</a>
                                            </h3>
                                            <div class="entry-meta mb-2">
                                                <ul class="global-list">
                                                    <li>By <a href="javascript:void(0)">{{ data_get($post, 'user.first_name') }}</a></li>
                                                    <li><a href="javascript:void(0)">{{ $post->updated_at->format('F j, Y') }}</a></li>
                                                </ul>
                                            </div>
                                            <p>{!! \Illuminate\Support\Str::limit($post->content, 120) !!}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        <div class="col-7 col-sm-6 text-left">
                            <div class="float-left">
                                {!! $posts->render() !!}
                            </div>
                        </div>
                        <!-- {{ $posts->links()}} -->
                        <!-- {!! $posts->render() !!} -->
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

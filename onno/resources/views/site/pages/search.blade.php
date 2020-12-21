@extends('site.layouts.app')

@section('content')
    <div class="sg-page-content">
        <div class="container">
            <div class="row">
                <div class="col-md-7 col-lg-8 sg-sticky">
                    <div class="theiaStickySidebar">
                        <div class="sg-section">
                            <div class="section-content search-content">
                                <div class="sg-search">
                                    <div class="search-form">
                                        <form action="{{ route('article.search') }}" id="search" method="GET">
                                            <input class="form-control" name="search" type="text" value="{{ request()->get('search', '') }}" placeholder="{{ __('search')  }}">
                                            <button type="submit"><i class="fa fa-search"></i></button>
                                        </form>
                                    </div>
                                </div>

                                @if(!blank($posts))
                                    @foreach($posts as $post)
                                        <div class="sg-post small-post post-style-1">
                                            <div class="entry-header">
                                                <div class="entry-thumbnail">
                                                    <a href="{{ route('article.detail', ['id' => $post->slug]) }}">
                                                        @if(isFileExist(@$post->image, @$post->image->small_image))
                                                            <img src="{{ basePath(@$post->image) }}/{{ @$post->image->small_image }}" class="img-fluid" {!! $post->title !!}>
                                                        @else
                                                            <img class="img-fluid" src="{{static_asset('default-image/default-240x160.png') }} "  {!! $post->title !!}>
                                                        @endif
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="entry-content">
                                                <a href="{{ route('article.detail', ['id' => $post->slug]) }}">{!! $post->title !!}</a>
                                                <div class="entry-meta">
                                                    <ul class="global-list">
                                                        <li>{{ __('post_by') }} <a href="javascript:void(0)">{{ data_get($post, 'user.first_name') }} {{ $post->updated_at->format('F j, Y') }}</a></li>
                                                    </ul>
                                                </div>
                                                <a href="{{ route('article.detail', ['id' => $post->slug]) }}" class="read-more">{{ __('read_now') }}</a>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif

                                <div class="sg-pagination text-center">
                                    {{ $posts->appends(request()->except('page'))->links('site.partials.search_pagination') }}
                                </div>
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

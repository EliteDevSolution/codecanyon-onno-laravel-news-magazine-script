@php
    //$posts = data_get($categorySection, 'category.post', collect([]));
    $firstPost = $posts->first();
    $bottomPosts = $posts->skip(1)->take(6);
@endphp

<div class="sg-section">
    <div class="section-content">
        <div class="section-title">
            <h1>
                @if(data_get($categorySection, 'label') == 'videos') 
                    {{__('videos')}}
                @else
                    {{ \Illuminate\Support\Str::upper(data_get($categorySection, 'label')) }}
                @endif
            </h1>
        </div>
        @if(!blank($firstPost))
            <div class="sg-post medium-post-style-1">
                @include('site.partials.home.category.first_post')
                <div class="entry-content align-self-center">
                    <h3 class="entry-title"><a
                            href="{{ route('article.detail', ['id' => $firstPost->slug]) }}">{!! \Illuminate\Support\Str::limit($firstPost->title, 65) !!}</a>
                    </h3>
                    <div class="entry-meta mb-2">
                        <ul class="global-list">
                            <li>{{__('post_by')}} <a href="javascript:void(0)">{{ data_get($firstPost, 'user.first_name') }}</a></li>
                            <li><a href="javascript:void(0)">{{ $firstPost->updated_at->format('F j, Y') }}</a></li>
                        </ul>
                    </div>
                    <p>{!! \Illuminate\Support\Str::limit($firstPost->content, 120) !!}</p>
                </div>
            </div>
        @endif
        <div class="row">
            @foreach($bottomPosts->chunk(3) as $postGroup)
                <div class="col-lg-6">
                    @foreach($postGroup as $post)
                        <div class="sg-post small-post post-style-1">
                            @include('site.partials.home.category.post_block')
                            <div class="entry-content">
                                <a href="{{ route('article.detail', ['id' => $post->slug]) }}"><p>{!! \Illuminate\Support\Str::limit($post->title, 35) !!}</p></a>
                                <div class="entry-meta">
                                    <ul class="global-list">
                                        <li>{{ __('post_by') }} <a href="javascript:void(0)">{{ data_get($firstPost, 'user.first_name') }} {{ $firstPost->updated_at->format('F j, Y') }}</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endforeach
        </div>
    </div>
</div>

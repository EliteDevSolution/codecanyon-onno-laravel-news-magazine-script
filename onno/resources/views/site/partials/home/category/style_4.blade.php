@php
    //$posts = data_get($categorySection, 'category.post', collect([]));
@endphp

<div class="sg-section">
    <div class="section-content mt-3">
        <div class="section-title">
            <h1>
                @if(data_get($categorySection, 'label') == 'videos') 
                    {{__('videos')}}
                @else
                    {{ \Illuminate\Support\Str::upper(data_get($categorySection, 'label')) }}
                @endif
            </h1>
        </div>
        <div class="row">
            @foreach($posts->take(3) as $post)
                <div class="col-lg-4">
                    <div class="sg-post">
                        @include('site.partials.home.category.post_block')
                        <div class="entry-content">
                            <a href="{{ route('article.detail', ['id' => $post->slug]) }}"><p>{!! \Illuminate\Support\Str::limit($post->title, 35) !!}</p></a>
                            <div class="entry-meta mt-2">
                                <ul class="global-list">
                                    <li>{{ __('post_by') }}<a href="javascript:void(0)">{{ $post->updated_at->format('F j, Y') }}</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>

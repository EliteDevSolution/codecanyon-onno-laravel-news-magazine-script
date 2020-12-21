<div class="sg-widget">
    <h3 class="widget-title">{{ data_get($detail, 'title') }}</h3>

    <ul class="global-list">
        @foreach($content as $post)
            <li>
                <div class="sg-post small-post post-style-1">
                    @include('site.partials.home.category.post_block')
                    <div class="entry-content">
                       <a href="{{ route('article.detail', ['id' => $post->slug]) }}"> <p>{{ \Illuminate\Support\Str::limit(data_get($post, 'title'), 70) }}</p></a>
                        <div class="entry-meta">
                            <ul class="global-list">
                                <li>{{ __('post_by') }} <a href="javascript:void(0)"> {{ data_get($post, 'user.first_name') }} {{ $post->updated_at->format('F j, Y') }}</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </li>
        @endforeach
    </ul>
</div>

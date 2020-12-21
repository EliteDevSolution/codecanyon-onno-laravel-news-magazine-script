<div class="sg-breaking-news">
    <div class="container">
        <div class="breaking-content d-flex">
            <span>{{ __('breaking_news') }}</span>
            <ul class="news-ticker">
            	@foreach($breakingNewss as $breakingNews)
                    <li><a href="{{ route('article.detail', [$breakingNews->slug]) }}">{{$breakingNews->title}}</a></li>
                @endforeach
            </ul><!-- #ticker -->
        </div><!-- /.breaking-content -->
    </div><!-- /.container -->
</div>

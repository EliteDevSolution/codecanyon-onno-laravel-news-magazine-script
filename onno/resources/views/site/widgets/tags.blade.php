<div class="sg-widget categories-widget">
    <h3 class="widget-title">{{ data_get($detail, 'title') }}</h3>
    <div class="tagcloud">
        @foreach( explode(',', data_get($detail, 'content')) as $tag)
            <a class="text-capitalize" href="{{ url('tags/'.$tag) }}">{{ $tag }}</a>
        @endforeach
    </div>
</div>

<div class="sg-widget categories-widget">
    <h3 class="widget-title">{{ __('categories') }}</h3>
    <ul class="global-list">
        @foreach($content as $item )
            <li><a href="{{ url('category',$item->slug) }}">{{ $item->category_name }} <span>({{ $item->post_count }})</span></a></li>
        @endforeach
    </ul>
</div>

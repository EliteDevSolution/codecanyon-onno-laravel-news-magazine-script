<div class="col-lg-4">
    <div class="footer-widget categories-widget">
        <h3>{{ data_get($detail, 'title') }}</h3>
        <ul class="global-list">
            @foreach($content as $item )
                @if ($loop->index > 6)
                    @break
                @endif
                <li><a href="#">{{ $item->category_name }} <span>({{ $item->post_count }})</span></a></li>
            @endforeach
        </ul>
    </div>
</div>

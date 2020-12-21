<feed>
    @foreach($items as $item)
        <entry>
            <title><![CDATA[{{ $item->title }}]]></title>
            <pubDate>{{ $item->updated->toRssString() }}</pubDate>
            <link><![CDATA[{{ url($item->link) }}]]></link>
            <description><![CDATA[
                @if($item->summary !=null)
                    <img height="300" width="500" src="{{ asset($item->summary) }}" alt="{{ $item->title }}">
                @else
                    <img height="300" width="500" src="{{static_asset('default-image/default-730x400.png') }}" alt="{{ $item->title }}">
                @endif;
                ]]>
            </description>
        </entry>
    @endforeach
</feed>

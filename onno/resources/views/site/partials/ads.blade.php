@if(!blank($ads))
    @foreach($ads as $headerWidget)
        @if(data_get($headerWidget, 'view') == 'ad_widget')
            @php
                $ad = data_get($headerWidget, 'detail.ad');
            @endphp
            <div class="sg-ad">
                <div class="container">
                    <div class="ad-content">
                        @if(@$ad->ad_type == 'image')
                            <a href="{{ data_get($ad, 'ad_url', '#') }}">
                                @if(isFileExist(@$ad->adImage, @$ad->adImage->original_image))
                                    <img class="img-fluid" src="{{basePath($ad->adImage)}}/{{ $ad->adImage->original_image }}" alt="{{ $ad->ad_name }}">
                                @else
                                    <img src="{{static_asset('default-image/default-ads.png') }} "  class="img-fluid"   alt="{!! $ad->ad_name !!}" >
                                @endif
                            </a>
                        @elseif(@$ad->ad_type == 'code')
                            {!! $ad->ad_code ?? '' !!}
                        @elseif(@$ad->ad_type == 'text')
                            {!! $ad->ad_text ?? '' !!}
                        @endif
                    </div>
                </div>
            </div>
        @endif
    @endforeach
@endif

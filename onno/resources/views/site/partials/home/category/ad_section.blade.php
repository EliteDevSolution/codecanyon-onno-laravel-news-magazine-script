@if(!blank($ad))
    <div class="sg-ad">
        <div class="container">
            <div class="ad-content">
                @if(data_get($ad, 'ad_type') == 'image')
                    <a href="{{ data_get($ad, 'ad_url', '#') }}">
                        @if(isFileExist(@$ad->adImage, $ad->adImage->original_image))
                            <img src=" {{basePath($ad->adImage)}}/{{ $ad->adImage->original_image }} " class="img-fluid"   alt="{!! $ad->ad_name !!}"  >

                        @else
                            <img src="{{static_asset('default-image/ads.png') }} "  class="img-fluid"   alt="{!! $ad->ad_name !!}" >
                        @endif
                    </a>
                @elseif(data_get($ad, 'ad_type') == 'code')
                    {!! $ad->ad_code ?? '' !!}
                @elseif(data_get($ad, 'ad_type') == 'text')
                    {!! $ad->ad_text ?? '' !!}
                @endif
            </div>
        </div>
    </div>
@endif

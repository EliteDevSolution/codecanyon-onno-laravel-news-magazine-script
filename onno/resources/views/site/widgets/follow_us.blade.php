<div class="sg-widget widget-social">
    <h3 class="widget-title">{{ __('stay_connected') }}</h3>
    <div class="sg-socail">
        <ul class="global-list">
            @foreach($socialMedias as $socialMedia)
                <li class="facebook"><a href="{{ $socialMedia->url?? '#' }}" style="background:{{$socialMedia->text_bg_color}}"><span style="background:{{$socialMedia->icon_bg_color}}"><i class="{{ $socialMedia->icon }}" aria-hidden="true"></i></span>{{$socialMedia->name}}</a></li>
            @endforeach
        </ul>
    </div>
</div><!-- /.sg-widget -->

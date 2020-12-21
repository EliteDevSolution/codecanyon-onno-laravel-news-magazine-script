 <div class="footer footer-style-1">
    <div class="footer-top">
        <div class="container">
            <div class="footer-content">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="footer-widget about-widget">
                            <h3>{{ __('about_us') }}</h3>
                            <p>{{ settingHelper('about_us_description') }}</p>
                            <ul class="global-list">
                                <li><i class="fa fa-home mr-2" aria-hidden="true"></i>{{ settingHelper('address') }}</li>
                                <li><i class="fa fa-volume-control-phone mr-2" aria-hidden="true"></i>{{ settingHelper('phone') }}</li>
                                <li><i class="fa fa-envelope-o mr-2" aria-hidden="true"></i> <a href="#">{{ settingHelper('email') }}</a></li>
                            </ul>
                        </div><!-- /.footer-widget -->
                    </div>

                    @foreach($footerWidgets as $widget)
                        @if($widget['view'] == 'editor_picks')
                            @include('site.widgets.footer.editor_picks', $widget)
                        @elseif($widget['view'] == 'categories')
                            @include('site.widgets.footer.categories', $widget)
                        @endif
                    @endforeach

                </div><!-- /.row -->
            </div>
        </div><!-- /.container -->
    </div>
    <div class="footer-bottom">
        <div class="container text-center">
            <div class="logo">
                <img src="{{static_asset(settingHelper('logo'))}}" alt="Logo" class="img-fluid" width="20%">
            </div>
            @foreach($footerWidgets as $widget)
                @if($widget['view'] == 'follow_us')
                    <div class="d-flex justify-content-center">
                        <div class="sg-socail">
                            <ul class="global-list d-flex">
                                @foreach($socialMedias as $socialMedia)
                                    <li><a href="{{$socialMedia->url}}" target="_blank"><i class="{{$socialMedia->icon}}" aria-hidden="true"></i></a></li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endif
            @endforeach
            <span>{{settingHelper('copyright_text')}}</span>
        </div><!-- /.container -->
    </div>
</div><!-- /.footer -->

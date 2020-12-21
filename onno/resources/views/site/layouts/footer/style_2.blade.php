<div class="footer footer-style-1">
    <div class="footer-top">
        <div class="container">
            <div class="footer-content">
                @foreach($footerWidgets as $widget)
                    @if($widget['view'] == 'follow_us')
                        <div class="d-flex justify-content-lg-center">
                            <div class="sg-socail">
                                <ul class="global-list d-flex">
                                    @foreach($socialMedias as $socialMedia)
                                        <li>
                                            <a href="{{$socialMedia->url}}" target="_blank"><i class="{{$socialMedia->icon}}" aria-hidden="true"></i></a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    @endif
                @endforeach
                <div class="row">

                    @foreach($footerWidgets as $widget)
                        @if($widget['view'] == 'popular_post')
                            @include('site.widgets.footer.popular_post', $widget)
                        @elseif($widget['view'] == 'editor_picks')
                            @include('site.widgets.footer.editor_picks', $widget)
                        @elseif($widget['view'] == 'newsletter')
                            @include('site.widgets.footer.newsletter', $widget)
                        @endif
                    @endforeach

                </div><!-- /.row -->
            </div>
        </div><!-- /.container -->
    </div>
    <div class="footer-bottom">
        <div class="container text-center">
            <span>{{settingHelper('copyright_text')}}</span>
        </div><!-- /.container -->
    </div>
</div><!-- /.footer -->

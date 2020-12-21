@extends('site.layouts.app')

@section('content')

 <div class="sg-page-content">
        <div class="container">
        	@if($page->show_breadcrumb == 1)
        	 <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('') }}">{{ __('home') }}</a></li>
                        <li class="breadcrumb-item"><a href="#">{!! $page->title ?? '' !!}</a></li>
                    </ol>
                </nav>
                @endif
	            <div class="row">
	            	<div class="{{ $page->template == 2? 'col-md-7 col-lg-8':'col-md-12 col-lg-12'}} sg-sticky">
	            		<div class="row">
			                <div class="col-md-12 col-lg-12 sg-sticky">
			                    <div class="theiaStickySidebar post-details">
			                        <div class="sg-section">
			                            <div class="section-content">
			                                <div class="sg-post">
			                                    <div class="entry-content p-4">
			                                    	@if($page->show_title == 1)
			                                            <h3>{!! $page->title ?? '' !!}</h3>
			                                        @endif

			                                        <div class="paragraph p-t-20">
			                                           {{ settingHelper('about_us_description') }}
			                                        </div>
			                                    </div>
			                                </div>
			                            </div>
			                        </div>
			                    </div>
			                </div>
			                <div class="col-md-12 col-lg-12 sg-sticky">
			                	<div class="row">
			                		<div class="{{ $page->template == 2? 'col-md-12':'col-md-6' }}">
			                			<div class="sg-section">
				                            <div class="section-content">
				                                <div class="section-title">
				                                    <h1>{{ __('send_a_message') }}</h1>
				                                </div><!-- /.section-title -->
				                                <form class="contact-form" name="contact-form" method="post" action="{{ route('site.send.message')}}">
				                                	@csrf
				                                    <div class="row">
				                                        <div class="col-lg-12">
				                                            <div class="form-group">
				                                                <label for="one">{{ __('name') }} *</label>
				                                                <input type="text" class="form-control" name="name" id="one" placeholder="{{__('input_user')}}">
				                                            </div>
				                                        </div>
				                                        <div class="col-lg-12">
				                                            <div class="form-group">
				                                                <label for="two">{{ __('email') }} *</label>
				                                                <input type="email" class="form-control" name="email" id="two" placeholder="{{__('input_email')}}">
				                                            </div>
				                                        </div>
				                                        <div class="col-sm-12">
				                                            <div class="form-group">
				                                                <label for="four">{{ __('message') }} *</label>
				                                                <textarea name="message" class="form-control" rows="7" id="four" placeholder="{{__('input_message')}}"></textarea>
				                                            </div>
				                                        </div>

				                                        @if( settingHelper('captcha_visibility') == 1 )
                                                            <div class="col-lg-12 text-center mb-4">
                                                                  {!! NoCaptcha::renderJs() !!}
                                                                  {!! NoCaptcha::display() !!}
                                                            </div>
						                                @endif

				                                    </div>
				                                    <div class="form-group">
				                                        <button type="submit" class="btn btn-primary">{{ __('submit_now') }}</button>
				                                    </div>
				                                </form>
				                            </div><!-- /.section-content -->
				                        </div><!-- /.sg-section -->
			                		</div>
			                		<div class="{{ $page->template == 2? 'col-md-12':'col-md-6' }} mt-5">
			                			<div class="theiaStickySidebar">
					                        <div class="sg-section">
					                            <div class="section-content">
					                                <div class="sg-post footer-widget">
					                                    <div class="entry-content p-4">
					                                        <ul class="global-list">
								                                <li><i class="fa fa-home mr-2" aria-hidden="true"></i>{{ settingHelper('address') }}</li>
								                                <li><i class="fa fa-home mr-2" aria-hidden="true"></i>{{ settingHelper('city') }} {{ settingHelper('zip_code') }}</li>
								                                <li><i class="fa fa-volume-control-phone mr-2" aria-hidden="true"></i>{{ settingHelper('phone') }}</li>
								                                <li><i class="fa fa-envelope-o mr-2" aria-hidden="true"></i> <a href="#">{{ settingHelper('email') }}</a></li>
								                            </ul>
					                                    </div>

								                        <div class="d-flex justify-content-lg-center footer-content">
										                    <div class="sg-socail">
										                        <ul class="global-list d-flex">
										                            @foreach($socialMedias as $socialMedia)
										                                <li><a href="{{$socialMedia->url}}" target="_blank"><i class="{{$socialMedia->icon}}" aria-hidden="true"></i></a></li>
										                            @endforeach

										                        </ul>
										                    </div>
										                </div>
					                                </div>
					                            </div>
					                        </div>
					                    </div>
			                	</div>
			                </div>
			            </div>
			        </div>
		        </div>
		        @if($page->template == 2)
                <div class="col-md-5 col-lg-4 sg-sticky">
                    <div class="sg-sidebar theiaStickySidebar">
                        @include('site.partials.right_sidebar_widgets')
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>

@endsection
@section('script')
	@if(defaultModeCheck() == 'sg-dark')
		<script type="text/javascript">
		    jQuery(function($){
		        $('.g-recaptcha').attr('data-theme', 'dark');
		    });
		</script>
	@endif
@endsection

@extends('site.layouts.app')

@section('content')

 <div class="sg-page-content">
        <div class="container">

            @if($page->show_breadcrumb == 1)
        	 <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('') }}">{{__('home')}}</a></li>
                        <li class="breadcrumb-item"><a href="#">{!! $page->title ?? '' !!}</a></li>
                    </ol>
                </nav>
                @endif

            <div class="row">

                <div class="{{ $page->template == 2? 'col-md-7 col-lg-8':'col-md-12 col-lg-12'}} sg-sticky">
                    <div class="theiaStickySidebar post-details">
                        <div class="sg-section">
                            <div class="section-content">
                                <div class="sg-post">
                                    <div class="entry-content p-4">
                                        @if($page->show_title == 1)
                                            <h3>{!! $page->title ?? '' !!}</h3>
                                        @endif
                                        <div class="paragraph p-t-20">
                                         {!! $page->description !!}
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

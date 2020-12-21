@extends('site.layouts.app')

@section('content')
    @if(!blank($primarySectionPosts))
    @include('site.partials.home.primary_section', [
        'section' => $primarySection,
        'posts' => $primarySectionPosts,
        'sliderPosts' => $sliderPosts,
    ])
    @endif

    <div class="sg-main-content mb-4">
        <div class="container">
            <div class="row">
                <div class="col-md-7 col-lg-8 sg-sticky">
                    <div class="theiaStickySidebar">
                        @include('site.partials.home.category_section')
                    </div>
                </div>
                <div class="col-md-5 col-lg-4 sg-sticky">
                    <div class="sg-sidebar theiaStickySidebar">
                        @include('site.partials.right_sidebar_widgets')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

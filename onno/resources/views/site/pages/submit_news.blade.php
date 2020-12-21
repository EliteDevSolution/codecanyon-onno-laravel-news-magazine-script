@extends('site.layouts.app')

@push('style')
    <link href="{{static_asset('vendor/tinymce/skins/lightgray/skin.min.css')}}" rel="stylesheet" />
@endpush

@section('content')
    <div class="sg-page-content">
        <div class="container">
            <div class="row">
                <div class="col-md-7 col-lg-8 sg-sticky">
                    <div class="theiaStickySidebar post-details">
                        <div class="sg-section">
                            <div class="section-content">
                                <div class="sg-section">
                                    <div class="section-content">
                                        <div class="section-title">
                                            <h1>{{ __('submit_news') }}</h1>
                                        </div>

                                        <form class="contact-form" name="submit-news-form" method="post" action="{{ route('submit.news.save') }}" enctype="multipart/form-data">
                                            @csrf

                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <label for="post_title" class="col-form-label">{{ __('title') }}</label>
                                                    <input id="post_title" name="title" value="{{ old('title') }}" type="text" class="form-control" required>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <label for="post_content" class="col-form-label">{{ __('content') }}</label>
                                                    <textarea name="content" value="{{ old('content') }}" id="post_content" cols="30" rows="5">{{old('content')}}</textarea>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-sm-12 mt-3">
                                                    <label for="image" class="col-form-label">{{ __('post_image') }}</label>
                                                    <input type="file" class="form-control" name="image" id="image" required>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-sm-12 mt-2">
                                                    @if(Cartalyst\Sentinel\Laravel\Facades\Sentinel::check())
                                                        <button type="submit" class="btn btn-primary">Submit</button>
                                                    @else
                                                        <a class="btn btn-primary" href="{{ route('site.login.form') }}">Login</a>
                                                    @endif
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-5 col-lg-4 sg-sticky">
                    <div class="sg-sidebar theiaStickySidebar">
                        @if(!blank($rightSidebarWidgets = $widgets[\Modules\Widget\Enums\WidgetLocation::RIGHT_SIDEBAR]))
                            @include('site.partials.right_sidebar_widgets', ['rightWidgets' => $rightSidebarWidgets])
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script src="{{static_asset('vendor/tinymce/tinymce.min.js')}}"></script>
    <script>
        //TinyMCE
        tinymce.init({
            selector: "textarea#post_content",
            theme: "modern",
            height: 400,
            plugins: [
                'advlist autolink lists link image charmap print preview hr anchor pagebreak',
                'searchreplace wordcount visualblocks visualchars code fullscreen',
                'insertdatetime media nonbreaking save table contextmenu directionality',
                'emoticons template paste textcolor colorpicker textpattern imagetools'
            ],
            toolbar1: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
            toolbar2: 'print preview media | forecolor backcolor emoticons',
            image_advtab: true
        });
    </script>
@endpush

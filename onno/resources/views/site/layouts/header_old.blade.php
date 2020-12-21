@php
    $primaryMenu = data_get($menuDetails, 'primary', []);
@endphp

<header class="sg-header">
    <div class="sg-topbar">
        <div class="container">
            <div class="d-md-flex justify-content-md-between">
                <div class="left-contennt">
                    <ul class="global-list">
                        <li><i class="fa fa-calendar mr-2" aria-hidden="true"></i>Monday, 11 November 2019</li>
                    </ul>
                </div>
                <div class="right-content d-flex">
                    <div class="d-flex">
                        <div class="submit-news">
                            <a href="{{ route('submit.news.form') }}">{{ __('submit_now')}}</a>
                        </div>
                        <div class="sg-language">
                            <select>
                                <option value="">English</option>
                                <option value="">English</option>
                                <option value="">English</option>
                            </select>
                        </div>
                    </div>
                    <div class="d-flex">
                        <div class="sg-social mr-md-5">
                            <ul class="global-list">
                                <li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                                <li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                                <li><a href="#"><i class="fa fa-google-plus" aria-hidden="true"></i></a></li>
                                <li><a href="#"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
                            </ul>
                        </div>
                        <div class="sg-user">
                            <span><i class="fa fa-user-circle mr-2" aria-hidden="true"></i>
                                @if(Cartalyst\Sentinel\Laravel\Facades\Sentinel::check())
                                    {{ Cartalyst\Sentinel\Laravel\Facades\Sentinel::getUser()->last_name }} /
                                    <a href="{{ route('site.logout') }}">Logout</a>
                                @else
                                    <a href="{{ route('site.login.form') }}">Login</a> / <a
                                        href="{{ route('site.register.form') }}"> SignUp</a>
                                @endif
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="sg-menu">
        <nav class="navbar navbar-expand-lg">
            <div class="container">
                <div class="menu-content">
                    <a class="navbar-brand" href="{{ route('home') }}"><img src="{{static_asset('site/images/logo.png') }}"
                                                                            alt="Logo" class="img-fluid"></a>

                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"><i class="fa fa-align-justify"></i></span>
                    </button>

                    <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                        <ul class="navbar-nav">
                            @if(!blank($customMenu = data_get($primaryMenu, 'custom')))
                                @foreach($customMenu as $item)
                                    <li class="nav-item sg-dropdown active">
                                        <a href="{{ data_get($item, 'url') }}">{{ data_get($item, 'label') }}<span><i
                                                    class="fa fa-angle-down" aria-hidden="true"></i></span></a>
                                        <ul class="sg-dropdown-menu">
                                            @foreach(data_get($item, 'list_item', []) as $dropdownItem)
                                                <li>
                                                    <a href="{{ data_get($dropdownItem, 'url') }}">{{ data_get($dropdownItem, 'label') }}</a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </li>
                                @endforeach
                            @endif

                            <li class="sg-dropdown mega-dropdown">
                                <a href="#">Life Style<span><i class="fa fa-angle-down"
                                                               aria-hidden="true"></i></span></a>
                                <div class="sg-dropdown-menu mega-dropdown-menu">
                                    <div class="mega-menu-content">
                                        <div class="row">
                                            <div class="col-md-2">
                                                <ul class="nav nav-tabs" role="tablist">
                                                    <li class="nav-item">
                                                        <a class="nav-link active" id="all-tab" data-toggle="tab"
                                                           href="#all" role="tab" aria-controls="all"
                                                           aria-selected="true">All</a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="nav-link" id="photography-tab" data-toggle="tab"
                                                           href="#photography" role="tab" aria-controls="photography"
                                                           aria-selected="false">Photography</a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="nav-link" id="business-tab" data-toggle="tab"
                                                           href="#business" role="tab" aria-controls="business"
                                                           aria-selected="false">Business</a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="nav-link" id="design-tab" data-toggle="tab"
                                                           href="#design" role="tab" aria-controls="design"
                                                           aria-selected="false">Design</a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="nav-link" id="tech-tab" data-toggle="tab" href="#tech"
                                                           role="tab" aria-controls="tech"
                                                           aria-selected="false">Tech</a>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="col-md-10">
                                                <div class="tab-content" id="myTabContent">
                                                    <div class="tab-pane fade show active" id="all" role="tabpanel"
                                                         aria-labelledby="all-tab">
                                                        <div class="row">
                                                            <div class="col-md-6 col-lg-3">
                                                                <div class="sg-post">
                                                                    <div class="entry-header">
                                                                        <div class="entry-thumbnail">
                                                                            <a href="details.html"><img
                                                                                    class="img-fluid"
                                                                                    src="{{static_asset('site/images/post/mid6.jpg') }}"
                                                                                    alt="Image"></a>
                                                                        </div>
                                                                    </div>
                                                                    <div class="entry-content">
                                                                        <p>Trump's Florida move get ripped on 'SNL</p>
                                                                        <div class="entry-meta">
                                                                            <ul class="global-list">
                                                                                <li>By <a href="#">May 4, 2019</a></li>
                                                                            </ul>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6 col-lg-3">
                                                                <div class="sg-post">
                                                                    <div class="entry-header">
                                                                        <div class="entry-thumbnail">
                                                                            <a href="details.html"><img
                                                                                    class="img-fluid"
                                                                                    src="{{static_asset('site/images/post/mid7.jpg') }}"
                                                                                    alt="Image"></a>
                                                                        </div>
                                                                    </div>
                                                                    <div class="entry-content">
                                                                        <p>Trump's Florida move get ripped on 'SNL</p>
                                                                        <div class="entry-meta">
                                                                            <ul class="global-list">
                                                                                <li>By <a href="#">May 4, 2019</a></li>
                                                                            </ul>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6 col-lg-3">
                                                                <div class="sg-post">
                                                                    <div class="entry-header">
                                                                        <div class="entry-thumbnail">
                                                                            <a href="details.html"><img
                                                                                    class="img-fluid"
                                                                                    src="{{static_asset('site/images/post/mid8.jpg') }}"
                                                                                    alt="Image"></a>
                                                                        </div>
                                                                    </div>
                                                                    <div class="entry-content">
                                                                        <p>Trump's Florida move get ripped on 'SNL</p>
                                                                        <div class="entry-meta">
                                                                            <ul class="global-list">
                                                                                <li>By <a href="#">May 4, 2019</a></li>
                                                                            </ul>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6 col-lg-3">
                                                                <div class="sg-post">
                                                                    <div class="entry-header">
                                                                        <div class="entry-thumbnail">
                                                                            <a href="details.html"><img
                                                                                    class="img-fluid"
                                                                                    src="{{static_asset('site/images/post/sm1.jpg') }}"
                                                                                    alt="Image"></a>
                                                                        </div>
                                                                    </div>
                                                                    <div class="entry-content">
                                                                        <p>Trump's Florida move get ripped on 'SNL</p>
                                                                        <div class="entry-meta">
                                                                            <ul class="global-list">
                                                                                <li>By <a href="#">May 4, 2019</a></li>
                                                                            </ul>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="tab-pane fade" id="photography" role="tabpanel"
                                                         aria-labelledby="photography-tab">
                                                        <div class="row">
                                                            <div class="col-md-6 col-lg-3">
                                                                <div class="sg-post">
                                                                    <div class="entry-header">
                                                                        <div class="entry-thumbnail">
                                                                            <a href="details.html"><img
                                                                                    class="img-fluid"
                                                                                    src="{{static_asset('site/images/post/mid11.jpg') }}"
                                                                                    alt="Image"></a>
                                                                        </div>
                                                                    </div>
                                                                    <div class="entry-content">
                                                                        <p>Trump's Florida move get ripped on 'SNL</p>
                                                                        <div class="entry-meta">
                                                                            <ul class="global-list">
                                                                                <li>By <a href="#">May 4, 2019</a></li>
                                                                            </ul>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6 col-lg-3">
                                                                <div class="sg-post">
                                                                    <div class="entry-header">
                                                                        <div class="entry-thumbnail">
                                                                            <a href="details.html"><img
                                                                                    class="img-fluid"
                                                                                    src="{{static_asset('site/images/post/mid10.jpg') }}"
                                                                                    alt="Image"></a>
                                                                        </div>
                                                                    </div>
                                                                    <div class="entry-content">
                                                                        <p>Trump's Florida move get ripped on 'SNL</p>
                                                                        <div class="entry-meta">
                                                                            <ul class="global-list">
                                                                                <li>By <a href="#">May 4, 2019</a></li>
                                                                            </ul>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6 col-lg-3">
                                                                <div class="sg-post">
                                                                    <div class="entry-header">
                                                                        <div class="entry-thumbnail">
                                                                            <a href="details.html"><img
                                                                                    class="img-fluid"
                                                                                    src="{{static_asset('site/images/post/mid9.jpg') }}"
                                                                                    alt="Image"></a>
                                                                        </div>
                                                                    </div>
                                                                    <div class="entry-content">
                                                                        <p>Trump's Florida move get ripped on 'SNL</p>
                                                                        <div class="entry-meta">
                                                                            <ul class="global-list">
                                                                                <li>By <a href="#">May 4, 2019</a></li>
                                                                            </ul>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6 col-lg-3">
                                                                <div class="sg-post">
                                                                    <div class="entry-header">
                                                                        <div class="entry-thumbnail">
                                                                            <a href="details.html"><img
                                                                                    class="img-fluid"
                                                                                    src="{{static_asset('site/images/post/sm8.jpg') }}"
                                                                                    alt="Image"></a>
                                                                        </div>
                                                                    </div>
                                                                    <div class="entry-content">
                                                                        <p>Trump's Florida move get ripped on 'SNL</p>
                                                                        <div class="entry-meta">
                                                                            <ul class="global-list">
                                                                                <li>By <a href="#">May 4, 2019</a></li>
                                                                            </ul>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="tab-pane fade" id="business" role="tabpanel"
                                                         aria-labelledby="business-tab">
                                                        <div class="row">
                                                            <div class="col-md-6 col-lg-3">
                                                                <div class="sg-post">
                                                                    <div class="entry-header">
                                                                        <div class="entry-thumbnail">
                                                                            <a href="details.html"><img
                                                                                    class="img-fluid"
                                                                                    src="{{static_asset('site/images/post/mid6.jpg') }}"
                                                                                    alt="Image"></a>
                                                                        </div>
                                                                    </div>
                                                                    <div class="entry-content">
                                                                        <p>Trump's Florida move get ripped on 'SNL</p>
                                                                        <div class="entry-meta">
                                                                            <ul class="global-list">
                                                                                <li>By <a href="#">May 4, 2019</a></li>
                                                                            </ul>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6 col-lg-3">
                                                                <div class="sg-post">
                                                                    <div class="entry-header">
                                                                        <div class="entry-thumbnail">
                                                                            <a href="details.html"><img
                                                                                    class="img-fluid"
                                                                                    src="{{static_asset('site/images/post/mid7.jpg') }}"
                                                                                    alt="Image"></a>
                                                                        </div>
                                                                    </div>
                                                                    <div class="entry-content">
                                                                        <p>Trump's Florida move get ripped on 'SNL</p>
                                                                        <div class="entry-meta">
                                                                            <ul class="global-list">
                                                                                <li>By <a href="#">May 4, 2019</a></li>
                                                                            </ul>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6 col-lg-3">
                                                                <div class="sg-post">
                                                                    <div class="entry-header">
                                                                        <div class="entry-thumbnail">
                                                                            <a href="details.html"><img
                                                                                    class="img-fluid"
                                                                                    src="{{static_asset('site/images/post/mid8.jpg') }}"
                                                                                    alt="Image"></a>
                                                                        </div>
                                                                    </div>
                                                                    <div class="entry-content">
                                                                        <p>Trump's Florida move get ripped on 'SNL</p>
                                                                        <div class="entry-meta">
                                                                            <ul class="global-list">
                                                                                <li>By <a href="#">May 4, 2019</a></li>
                                                                            </ul>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6 col-lg-3">
                                                                <div class="sg-post">
                                                                    <div class="entry-header">
                                                                        <div class="entry-thumbnail">
                                                                            <a href="details.html"><img
                                                                                    class="img-fluid"
                                                                                    src="{{static_asset('site/images/post/sm1.jpg') }}"
                                                                                    alt="Image"></a>
                                                                        </div>
                                                                    </div>
                                                                    <div class="entry-content">
                                                                        <p>Trump's Florida move get ripped on 'SNL</p>
                                                                        <div class="entry-meta">
                                                                            <ul class="global-list">
                                                                                <li>By <a href="#">May 4, 2019</a></li>
                                                                            </ul>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="tab-pane fade" id="design" role="tabpanel"
                                                         aria-labelledby="design-tab">
                                                        <div class="row">
                                                            <div class="col-md-6 col-lg-3">
                                                                <div class="sg-post">
                                                                    <div class="entry-header">
                                                                        <div class="entry-thumbnail">
                                                                            <a href="details.html"><img
                                                                                    class="img-fluid"
                                                                                    src="{{asset('site/images/post/mid9.jpg')}}"
                                                                                    alt="Image"></a>
                                                                        </div>
                                                                    </div>
                                                                    <div class="entry-content">
                                                                        <p>Trump's Florida move get ripped on 'SNL</p>
                                                                        <div class="entry-meta">
                                                                            <ul class="global-list">
                                                                                <li>By <a href="#">May 4, 2019</a></li>
                                                                            </ul>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6 col-lg-3">
                                                                <div class="sg-post">
                                                                    <div class="entry-header">
                                                                        <div class="entry-thumbnail">
                                                                            <a href="details.html"><img
                                                                                    class="img-fluid"
                                                                                    src="{{static_asset('site/images/post/mid3.jpg') }}"
                                                                                    alt="Image"></a>
                                                                        </div>
                                                                    </div>
                                                                    <div class="entry-content">
                                                                        <p>Trump's Florida move get ripped on 'SNL</p>
                                                                        <div class="entry-meta">
                                                                            <ul class="global-list">
                                                                                <li>By <a href="#">May 4, 2019</a></li>
                                                                            </ul>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6 col-lg-3">
                                                                <div class="sg-post">
                                                                    <div class="entry-header">
                                                                        <div class="entry-thumbnail">
                                                                            <a href="details.html"><img
                                                                                    class="img-fluid"
                                                                                    src="{{static_asset('site/images/post/mid6.jpg') }}"
                                                                                    alt="Image"></a>
                                                                        </div>
                                                                    </div>
                                                                    <div class="entry-content">
                                                                        <p>Trump's Florida move get ripped on 'SNL</p>
                                                                        <div class="entry-meta">
                                                                            <ul class="global-list">
                                                                                <li>By <a href="#">May 4, 2019</a></li>
                                                                            </ul>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6 col-lg-3">
                                                                <div class="sg-post">
                                                                    <div class="entry-header">
                                                                        <div class="entry-thumbnail">
                                                                            <a href="details.html"><img
                                                                                    class="img-fluid"
                                                                                    src="{{static_asset('site/images/post/sm1.jpg') }}"
                                                                                    alt="Image"></a>
                                                                        </div>
                                                                    </div>
                                                                    <div class="entry-content">
                                                                        <p>Trump's Florida move get ripped on 'SNL</p>
                                                                        <div class="entry-meta">
                                                                            <ul class="global-list">
                                                                                <li>By <a href="#">May 4, 2019</a></li>
                                                                            </ul>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="tab-pane fade" id="tech" role="tabpanel"
                                                         aria-labelledby="tech-tab">
                                                        <div class="row">
                                                            <div class="col-md-6 col-lg-3">
                                                                <div class="sg-post">
                                                                    <div class="entry-header">
                                                                        <div class="entry-thumbnail">
                                                                            <a href="details.html"><img
                                                                                    class="img-fluid"
                                                                                    src="{{static_asset('site/images/post/mid2.jpg') }}"
                                                                                    alt="Image"></a>
                                                                        </div>
                                                                    </div>
                                                                    <div class="entry-content">
                                                                        <p>Trump's Florida move get ripped on 'SNL</p>
                                                                        <div class="entry-meta">
                                                                            <ul class="global-list">
                                                                                <li>By <a href="#">May 4, 2019</a></li>
                                                                            </ul>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6 col-lg-3">
                                                                <div class="sg-post">
                                                                    <div class="entry-header">
                                                                        <div class="entry-thumbnail">
                                                                            <a href="details.html"><img
                                                                                    class="img-fluid"
                                                                                    src="{{static_asset('site/images/post/mid5.jpg') }}"
                                                                                    alt="Image"></a>
                                                                        </div>
                                                                    </div>
                                                                    <div class="entry-content">
                                                                        <p>Trump's Florida move get ripped on 'SNL</p>
                                                                        <div class="entry-meta">
                                                                            <ul class="global-list">
                                                                                <li>By <a href="#">May 4, 2019</a></li>
                                                                            </ul>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6 col-lg-3">
                                                                <div class="sg-post">
                                                                    <div class="entry-header">
                                                                        <div class="entry-thumbnail">
                                                                            <a href="details.html"><img
                                                                                    class="img-fluid"
                                                                                    src="{{static_asset('site/images/post/mid8.jpg') }}"
                                                                                    alt="Image"></a>
                                                                        </div>
                                                                    </div>
                                                                    <div class="entry-content">
                                                                        <p>Trump's Florida move get ripped on 'SNL</p>
                                                                        <div class="entry-meta">
                                                                            <ul class="global-list">
                                                                                <li>By <a href="#">May 4, 2019</a></li>
                                                                            </ul>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6 col-lg-3">
                                                                <div class="sg-post">
                                                                    <div class="entry-header">
                                                                        <div class="entry-thumbnail">
                                                                            <a href="details.html"><img
                                                                                    class="img-fluid"
                                                                                    src="{{static_asset('site/images/post/sm3.jpg') }}"
                                                                                    alt="Image"></a>
                                                                        </div>
                                                                    </div>
                                                                    <div class="entry-content">
                                                                        <p>Trump's Florida move get ripped on 'SNL</p>
                                                                        <div class="entry-meta">
                                                                            <ul class="global-list">
                                                                                <li>By <a href="#">May 4, 2019</a></li>
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
                            </li>

                            @if(!blank($categoryMenu = data_get($primaryMenu, 'category')))
                                <li class="sg-dropdown mega-dropdown">
                                    <a href="javascript:void(0)">Category<span><i class="fa fa-angle-down"
                                                                                  aria-hidden="true"></i></span></a>
                                    <div class="sg-dropdown-menu mega-dropdown-menu">
                                        <div class="mega-menu-content">
                                            <div class="row">
                                                @foreach($categoryMenu as $label =>  $items)
                                                    <div class="col-md-3">
                                                        <h3>{{ $label }}</h3>
                                                        <ul class="global-list">
                                                            @foreach($items as $item)
                                                                <li>
                                                                    <a href="{{ data_get($item, 'url', '#') }}">{{ data_get($item, 'label') }}</a>
                                                                </li>
                                                            @endforeach
                                                        </ul>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            @endif
                            @if(!blank($pageMenu = data_get($primaryMenu, 'page')))
                                <li class="sg-dropdown">
                                    <a href="javascript:void(0)">Pages<span><i class="fa fa-angle-down"
                                                              aria-hidden="true"></i></span></a>
                                    <ul class="sg-dropdown-menu">
                                        @foreach($pageMenu as $menu)
                                        <li><a href="{{ data_get($menu, 'url') }}">{{ data_get($menu, 'label') }}</a></li>
                                        @endforeach
                                    </ul>
                                </li>
                            @endif
                            <li><a href="#">About</a></li>
                            <li><a href="#">All Category</a></li>
                        </ul>
                    </div>

                    <div class="sg-search">
                        <div class="search-form">
                            <form action="{{ route('article.search') }}" id="search" method="GET">
                                <input class="form-control" name="search" type="text" placeholder="{{ __('Search here..') }}">
                                <button type="submit"><i class="fa fa-search"></i></button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
    </div>
</header>

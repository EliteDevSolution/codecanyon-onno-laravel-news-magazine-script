<header class="sg-header">
    <div class="sg-topbar">
        <div class="container">
            <div class="d-md-flex justify-content-md-between">
                <div class="left-contennt">
                    <ul class="global-list">
                        <li><i class="fa fa-calendar mr-2" aria-hidden="true"></i>{{date('l, d F Y')}}</li>
                    </ul>
                </div>
                <div class="right-content d-flex">
                    <div class="d-flex">
                        <div class="submit-news d-none d-md-block">
                            <a href="{{ route('submit.news.form') }}">{{__('submit_now')}}</a>
                        </div>
                        <input type="hidden" id="url" value="{{ url('') }}">
                            <div class="sg-language">
                                <select name="code" id="languges-changer">
                                    @foreach ($activeLang as $lang)
                                        <option value="{{$lang->code}}" {{ LaravelLocalization::setLocale() == ""? ( settingHelper('default_language') == $lang->code? 'selected':'' ) : (LaravelLocalization::setLocale() == $lang->code ? 'selected':'') }}>{{ $lang->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                    </div>
                    <div class="d-flex ">
                        <div class="sg-social d-none d-xl-block mr-md-5">
                            <ul class="global-list">
                                @foreach($socialMedias as $socialMedia)
                                <li><a href="{{$socialMedia->url}}" target="_blank"><i class="{{$socialMedia->icon}}" aria-hidden="true"></i></a></li>
                                @endforeach
                                <li><a href="{{ url('feed') }}"><i class="fa fa-rss" aria-hidden="true"></i></a></li>
                            </ul>
                        </div>
                        <div class="sg-user">
                            @if(Cartalyst\Sentinel\Laravel\Facades\Sentinel::check())
                            <div class="dropdown">
                                <a class="nav-user-img" href="#" id="navbarDropdownMenuLink2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fa fa-user-circle mr-2"></i>{{ Sentinel::getUser()->first_name}}<i class="fa fa-angle-down  ml-2" aria-hidden="true"></i></a>

                                <div class="dropdown-menu dropdown-menu-right nav-user-dropdown site-setting-area" aria-labelledby="navbarDropdownMenuLink2">

                                    @if(Sentinel::getUser()->roles[0]->id != 4 && Sentinel::getUser()->roles[0]->id != 5)
                                    <a class="" href="{{ route('dashboard') }} " target="_blank"><i class="fa fa-tachometer mr-2" aria-hidden="true"></i>{{__('dashboard')}}</a>
                                    @endif
                                    <a class=""  href="{{ route('user-account') }}" target="_blank"><i class="fa fa-user mr-2"></i>{{__('profile')}}</a>
                                    
                                    <a class="" href="{{ route('site.logout') }}"><i class="fa fa-power-off mr-2"></i>{{__('logout')}}</a>
                                    
                                </div>
                            </div>
                            @else
                                <span>
                                    <i class="fa fa-user-circle mr-2" aria-hidden="true"></i>
                                    <a href="{{ route('site.login.form') }}">{{ __('login') }}</a> <span class="d-none-small">/ <a href="{{ route('site.register.form') }}"> {{ __('sign_up') }}</a></span>
                                </span>
                            @endif
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
                    <a class="navbar-brand" href="{{ route('home') }}">
                        <img src="{{ static_asset(settingHelper('logo')) }}" alt="Logo" class="img-fluid">
                    </a>

                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"><i class="fa fa-align-justify"></i></span>
                    </button>

                    <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                        <ul class="navbar-nav">

                            @foreach($primaryMenu as $mainMenu)

                                @if($mainMenu->is_mega_menu == 'no')
                                    <li class="nav-item sg-dropdown">
                                        <a href="{{menuUrl($mainMenu)}}" target="{{$mainMenu->new_teb == 1? '_blank':''}}">{{@$mainMenu->label}} @if(!blank($mainMenu->children))<span><i class="fa fa-angle-down" aria-hidden="true"></i></span>@endif </a>
                                        <ul class="sg-dropdown-menu">
                                            @foreach($mainMenu->children as $child)
                                                <li class=""><a href="{{menuUrl($child)}}" target="{{$child->new_teb == 1? '_blank':''}}">{{@$child->label}} @if(!blank($child->children)) <span class="pull-right"><i class="fa fa-angle-right" aria-hidden="true"></i></span>@endif</a>
                                                    <ul class="sg-dropdown-menu-menu">
                                                        @foreach($child->children as $subChild)
                                                            <li class=""><a href="{{menuUrl($subChild)}}" target="{{$subChild->new_teb == 1? '_blank':''}}">{{@$subChild->label}}</a></li>
                                                        @endforeach
                                                    </ul>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </li>
                                @endif

                                @if($mainMenu->is_mega_menu == 'tab')

                                    <li class="sg-dropdown mega-dropdown">
                                        <a href="{{menuUrl($mainMenu)}}">{{$mainMenu->label}}<span><i class="fa fa-angle-down" aria-hidden="true"></i></span></a>
                                        <div class="sg-dropdown-menu mega-dropdown-menu">
                                            <div class="mega-menu-content">
                                                <div class="row">
                                                    <div class="col-md-2">
                                                        <ul class="nav nav-tabs" role="tablist">
                                                            @foreach($mainMenu->children as $child)
                                                                @php $key = 0 @endphp
                                                                    <li class="nav-item">
                                                                        <a class="nav-link {{$mainMenu->children[$key]->id == $child->id? 'active':''}}" id="{{$child->label}}-tab" data-toggle="tab" href="#{{$child->category->slug}}" role="tab" aria-controls="{{$child->label}}" aria-selected="{{$mainMenu->children[$key]->id == $child->id? 'true':'false'}}">{{$child->label}}</a>
                                                                    </li>
                                                                @php $key++ @endphp
                                                            @endforeach
                                                        </ul>
                                                    </div>
                                                    <div class="col-md-10">
                                                        <div class="tab-content" id="myTabContent">
                                                            @foreach($mainMenu->children as $child)
                                                                <div class="tab-pane fade {{$mainMenu->children[0]->id == $child->id? 'show active':''}}" id="{{$child->category->slug}}" role="tabpanel" aria-labelledby="{{$child->label}}-tab">
                                                                    <div class="row">
                                                                        @foreach($child->postByCategory as $item)
                                                                            <div class="col-md-6 col-lg-3">
                                                                                <div class="sg-post">
                                                                                    <div class="entry-header">
                                                                                        <div class="entry-thumbnail">
                                                                                            <a href="{{ route('article.detail', ['id' => $item->slug]) }}">
                                                                                                @if(isFileExist(@$item->image, @$item->image->small_image))
                                                                                                    <img class="img-fluid" src="{{basePath(@$item->image)}}/{{ @$item->image->small_image }}" alt="{!! $item->title !!}">
                                                                                                @else
                                                                                                    <img class="img-fluid" src="{{static_asset('default-image/default-240x160.png') }}"  alt="{!! $item->title !!}">
                                                                                                @endif
                                                                                            </a>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="entry-content">
                                                                                        <a href="{{ route('article.detail', ['id' => $item->slug]) }}"><p>{!!Str::limit($item->content, 35)!!}</p></a>
                                                                                        <div class="entry-meta">
                                                                                            <ul class="global-list">
                                                                                                <li>{{ __('post_by') }} <a href="#">{{date('d F Y', strtotime($item->created_at))}}</a></li>
                                                                                            </ul>
                                                                                        </div><!-- /.entry-meta -->
                                                                                    </div><!-- /.entry-content -->
                                                                                </div><!-- /.sg-post -->
                                                                            </div>
                                                                        @endforeach
                                                                    </div><!-- /.row -->
                                                                </div><!-- /.tab-pane -->
                                                            @endforeach
                                                        </div><!-- /.tab-content -->
                                                    </div>
                                                </div><!-- /.row -->
                                            </div><!-- /.mega-menu-content -->
                                        </div>
                                    </li>
                                @endif

                                @if($mainMenu->is_mega_menu == 'category')
                                    <li class="sg-dropdown mega-dropdown">
                                        <a href="{{menuUrl($mainMenu)}}" target="{{$mainMenu->new_teb == 1? '_blank':''}}">{{$mainMenu->label}} @if(!blank($mainMenu->children))<span><i class="fa fa-angle-down" aria-hidden="true"></i></span>@endif</a>
                                        <div class="sg-dropdown-menu mega-dropdown-menu">
                                            <div class="mega-menu-content">
                                                <div class="row">
                                                    @foreach($mainMenu->children as $child)
                                                        <div class="col-md-3">
                                                            <h3>{{$child->label}}</h3>
                                                            <ul class="global-list">
                                                                 @foreach($child->children as $subChild)
                                                                    <li><a href="{{menuUrl($subChild)}}" target="{{$subChild->new_teb == 1? '_blank':''}}">{{$subChild->label}}</a></li>
                                                                 @endforeach
                                                            </ul>
                                                        </div>
                                                    @endforeach
                                                </div><!-- /.row -->
                                            </div><!-- /.mega-menu-content -->
                                        </div>
                                    </li>
                                @endif

                            @endforeach
                        </ul>
                    </div>

                    <div class="sg-search">
                        <div class="search-form">
                            <form action="{{ route('article.search') }}" id="search" method="GET">
                                <input class="form-control" name="search" type="text" placeholder="{{ __('search') }}">
                                <button type="submit"><i class="fa fa-search"></i></button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
    </div>
</header>

@if(data_get(activeTheme(), 'options.header_style') == 'header_1')
<div class="container">
    <div class="row">
        <div class="col-12">
            @if(session('error'))
                <div id="error_m" class="alert alert-danger">
                    {{session('error')}}
                </div>
            @endif
            @if(session('success'))
                <div id="success_m" class="alert alert-success">
                    {{session('success')}}
                </div>
            @endif
            @isset($errors)
            @if ($errors->any())
                <div class="alert alert-danger" id="error_m">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @endif
        </div>
    </div>
</div>
@endif

@include('site.partials.ads', ['ads' => $headerWidgets])

 <header class="sg-header">
     <div class="sg-topbar topbar-style-2">
         <div class="container">
             <div class="d-md-flex justify-content-md-between">
                 <div class="left-contennt">
                     <div class="logo-text-wrap">
                         <h1><a class="" href="{{ route('home') }}"><img src="{{ static_asset(settingHelper('logo')) }}" alt="Logo" class="img-fluid"></a></h1>
                     </div>
                 </div><!-- /.left-contennt -->
                 <div class="middle-content">
                     <div class="d-flex  justify-content-between">
                         <div class="weather-content d-flex align-self-center">
                             <div class="date">
                                 <span><i class="fa fa-calendar mr-2" aria-hidden="true"></i>{{date('l, d F Y')}}</span>
                             </div>
                         </div>
                         <div class="sg-search">
                             <div class="search-form">
                                 <form action="{{ route('article.search') }}" id="search" method="GET">
                                     <input class="form-control" name="search" type="text" placeholder="{{ __('search') }}">
                                     <button type="submit"><i class="fa fa-search"></i></button>
                                 </form>
                             </div>
                         </div>
                         <div class="sg-user ml-4 mt-2">
                             @if(Cartalyst\Sentinel\Laravel\Facades\Sentinel::check())
                                 <div class="dropdown">
                                     <a class="nav-user-img" href="#" id="navbarDropdownMenuLink2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                         <i class="fa fa-user-circle mr-2"></i>{{ Sentinel::getUser()->first_name}}<i class="fa fa-angle-down  ml-2" aria-hidden="true"></i>
                                     </a>

                                     <div class="dropdown-menu dropdown-menu-right nav-user-dropdown site-setting-area" aria-labelledby="navbarDropdownMenuLink2">
                                         @if(Sentinel::getUser()->roles[0]->id != 4 && Sentinel::getUser()->roles[0]->id != 5)
                                         <a class="" href="{{ route('dashboard') }}" target="_blank"><i class="fa fa-tachometer mr-2" aria-hidden="true"></i>{{__('dashboard')}}</a>
                                         @endif
                                         <a class="" href="{{ route('user-account') }}" target="_blank"><i class="fa fa-user mr-2"></i>{{__('account')}}</a>
                                         <a class="" onclick="document.getElementById('logout-form').submit()" href="#"><i class="fa fa-power-off mr-2"></i>{{__('logout')}}</a>
                                         {!!  Form::open(['route' => 'site.logout', 'method' => 'post','id'=>'logout-form']) !!}
                                            @csrf
                                         {{ Form::close() }}
                                     </div>
                                 </div>
                             @else
                                 <span>
                                    <i class="fa fa-user-circle mr-2" aria-hidden="true"></i>
                                    <a href="{{ route('site.login.form') }}">{{ __('login') }}</a> / <a href="{{ route('site.register.form') }}"> {{ __('sign_up') }}</a>
                                </span>
                             @endif
                         </div>
                     </div>
                     <div class="ad-thumb">
                         @include('site.partials.ads', ['ads' => $headerWidgets])
                     </div>
                 </div>
                 @if($lastPost != null)
                 <div class="right-content">
                     <div class="sg-post small-post">
                         <div class="entry-header">
                             <div class="entry-thumbnail">
                                 <a href="{{ route('article.detail', ['id' => $lastPost->slug]) }}">
                                     @if(isFileExist(@$lastPost->image, @$lastPost->image->small_image))
                                         <img src=" {{basePath($lastPost->image)}}/{{ $lastPost->image->small_image }} " class="img-fluid"   alt="{!! $lastPost->title !!}"  >
                                     @else
                                         <img src="{{static_asset('default-image/default-240x160.png') }} "  class="img-fluid"   alt="{!! $lastPost->title !!}" >
                                     @endif
                                 </a>
                             </div>
                             @if($lastPost->post_type=="video")
                                 <div class="video-icon-catagory">
                                     <i class="fa fa-play" aria-hidden="true"></i>
                                 </div>
                             @endif
                         </div>
                         <div class="entry-content absolute">
                             <div class="category">
                                 <ul class="global-list">
                                     <li><a href="#">{{@$lastPost->category->category_name}}</a></li>
                                 </ul>
                             </div>
                             <p><a href="{{ route('article.detail', ['id' => $lastPost->slug]) }}">{{\Illuminate\Support\Str::limit(@$lastPost->title, 30) }}</a></p>
                         </div><!-- /.entry-content -->
                     </div>
                 </div>
                 @endif<!-- /.right-content -->
             </div>
         </div><!-- /.container -->
     </div><!-- /.sg-topbar -->

     <div class="sg-menu menu-style-2">
         <nav class="navbar navbar-expand-lg">
             <div class="container">
                 <div class="menu-content">
                     <a class="navbar-brand p-0 sm-logo" href="index.html"><img src="{{ static_asset(settingHelper('logo')) }}" alt="Logo" class="img-fluid mt-2"></a>
                     <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                         <span class="navbar-toggler-icon mt-0"><i class="fa fa-align-justify"></i></span>
                     </button>

                     <div class="collapse navbar-collapse" id="navbarNav">
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
                                                                 <li class="nav-item">
                                                                     <a class="nav-link {{$mainMenu->children[0]->id == $child->id? 'active':''}}" id="{{$child->label}}-tab" data-toggle="tab" href="#{{$child->category->slug}}" role="tab" aria-controls="{{$child->label}}" aria-selected="{{$mainMenu->children[0]->id == $child->id? 'true':'false'}}">{{$child->label}}</a>
                                                                 </li>
                                                             @endforeach
                                                         </ul>
                                                     </div>
                                                     <div class="col-md-10">
                                                         <div class="tab-content" id="myTabContent">
                                                             @foreach($mainMenu->children as $child)
                                                                 <div class="tab-pane fade {{$mainMenu->children[0]->id == $child->id? 'show active':''}}" id="{{$child->category->slug}}" role="tabpanel" aria-labelledby="{{$child->category->slug}}-tab">
                                                                     <div class="row">
                                                                         @foreach($child->postByCategory as $item)
                                                                             <div class="col-md-6 col-lg-3">
                                                                                 <div class="sg-post">
                                                                                     <div class="entry-header">
                                                                                         <div class="entry-thumbnail">
                                                                                             <a href="{{ route('article.detail', ['id' => $item->slug]) }}">
                                                                                                 @if(isFileExist(@$item->image, @$item->image->small_image))
                                                                                                     <img src=" {{basePath($item->image)}}/{{ $item->image->small_image }} " class="img-fluid"   alt="{!! $item->title !!}"  >
                                                                                                 @else
                                                                                                     <img src="{{static_asset('default-image/default-240x160.png') }} "  class="img-fluid"   alt="{!! $item->title !!}" >
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
                 </div><!-- /.menu-content -->
             </div><!-- /.container -->
         </nav><!-- /.navbar -->
     </div><!-- /.sg-menu -->
 </header><!-- /.sg-header -->

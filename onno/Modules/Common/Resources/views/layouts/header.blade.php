<!-- ============================================================== -->
<!-- navbar -->
<!-- ============================================================== -->
<div class="dashboard-header">
        <nav class="navbar navbar-expand-lg bg-white fixed-top">
            @if(Sentinel::getUser()->roles[0]->name != 'User' && Sentinel::getUser()->roles[0]->name != 'Subscriber')

            <a class="navbar-brand" href="{{ route('dashboard') }}">{{ settingHelper('application_name') }}</a>

            @else

            <a class="navbar-brand" href="{{ route('user-account') }}">{{ settingHelper('application_name') }}</a>

            @endif

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse " id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto navbar-right-top">
                    <li class="nav-item" >
                        <a class="nav-link" href="{{ url('/') }}" target="_blank"><i class="fas fa-globe"></i></a>
                    </li>
                    @if(Sentinel::getUser()->roles[0]->name != 'User' && Sentinel::getUser()->roles[0]->name != 'Subscriber')
                    <li class="nav-item dropdown connection">
                        <a class="nav-link" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-language"></i>  </a>
                        <ul class="dropdown-menu dropdown-menu-right connection-dropdown">
                            <li class="connection-list">
                                <div class="row">
                                    @foreach ($activeLang as $lang)
                                        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12 align-center">
                                            <a href="{{ route('switch-language',['code'=> $lang->code]) }}" class="connection-item @if(App::getLocale()== $lang->code) active  @endif"><i class="fa-3x {{ $lang->icon_class }}"></i> <span>{{ $lang->name }}</span></a>
                                        </div>
                                    @endforeach
                                </div>
                            </li>
                        </ul>
                    </li>
                    @endif

                    <li class="nav-item dropdown nav-user">
                        <a class="nav-link nav-user-img" href="#" id="navbarDropdownMenuLink2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

                            @if(Sentinel::getUser()->image != null)
                                <img src=" {{basePath(Sentinel::getUser()->image)}}/{{ Sentinel::getUser()->image['thumbnail'] }} " class="user-avatar-md rounded-circle"   alt="{{Sentinel::getUser()->first_name}}"  >
                            @else
                                <img src="{{static_asset('default-image/user.jpg') }} "  class="user-avatar-md rounded-circle"  alt="{{Sentinel::getUser()->first_name}}" >
                            @endif

                            <div class="dropdown-menu dropdown-menu-right nav-user-dropdown" aria-labelledby="navbarDropdownMenuLink2">
                                <div class="nav-user-info">
                                    <h5 class="mb-0 text-white nav-user-name">{{ Sentinel::getUser() ? Sentinel::getUser()->first_name.' '.Sentinel::getUser()->last_name : '' }}</h5>
                                </div>
                                <a class="dropdown-item" href="{{ route('user-account') }}"><i class="fas fa-user mr-2"></i>{{__('profile')}}</a>
                                <a class="dropdown-item" href="{{ route('site.logout') }}"><i class="fas fa-power-off mr-2"></i>{{__('logout')}}</a>
                                    
                            </div>
                        </a>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
    <!-- ============================================================== -->
    <!-- end navbar -->
    <!-- ============================================================== -->

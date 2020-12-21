@php
    if(!blank($posts)):
        if($bulk_email_type == 2)
            $single_post = @$posts->first();
        else
            $single_post = @$posts->last();
    endif;
@endphp

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <title></title> <!-- The title tag shows in email notifications, like Android 4.4. -->
    <link href="https://fonts.googleapis.com/css?family=Work+Sans:200,300,400,500,600,700" rel="stylesheet">
    <!-- CSS Reset : BEGIN -->
    <link rel="stylesheet" href="{{static_asset('css/multi-email.css') }}">
    <!-- CSS Reset : END -->
</head>

<body width="100%" class="begin-body">
<center class="centering">
    <div id="diving">
    </div>
    <div class="email-container email-container-modify">
        <!-- BEGIN BODY -->
        <table align="center" role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%" id="margining">
            <tr>
                <td valign="top" class="bg_white" id="bg-white-modify">
                    <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%">
                        <tr>
                            <td class="logo table-logo">
                                <h1><a href="{{$base_url}}"><img src="{{static_asset(settingHelper('logo'))}}" alt="{{ settingHelper('application_name') }}" width="100%"></a></h1>
                            </td>
                            <td id="application-name">{{ settingHelper('application_name') }}</td>
                        </tr>
                        <tr>
                            <td colspan="2" class="text-center">
                                <h2>

                                    @if($bulk_email_type == 2)

                                        {{__('latest_post')}}

                                    @elseif($bulk_email_type == 1)

                                        {{__('popular_post')}}

                                    @else

                                        {{__('recommended_post')}}

                                    @endif

                                </h2>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr><!-- end tr -->

            @if(!blank($posts))
                <tr>
                    <td valign="middle" class="hero bg_white bg-white-modify" style="background-image: url({{static_asset(@$single_post->image->original_image)}});">
                        <div class="overlay"></div>
                        <table>
                            <tr>
                                <td>
                                    <div class="text text-center p-1">
                                        <h2>{{ @$single_post->title }}</h2>
                                        <p>{!! \Illuminate\Support\Str::limit(@$single_post->content, 40) !!}</p>
                                        @if(@$single_post->post_type == 'article')
                                            <p><a href="{{$base_url}}/{{settingHelper('article_detail_prefix') ?? 'article'}}/{{$single_post->slug}}" class="btn btn-primary">{{__('read_more')}}</a></p>
                                        @else
                                            <div class="icon">
                                                <a href="{{$base_url}}/{{settingHelper('article_detail_prefix') ?? 'article'}}/{{@$single_post->slug}}">
                                                    <img src="{{static_asset('images/002-play-button.png')}}" alt="" class="icon-image">
                                                </a>
                                            </div>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr><!-- end tr -->
                <tr>
                    <td class="bg_white email-section">
                        <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%">

                            @php $i = 0; @endphp
                            @foreach($posts as $post)
                                @if($post->id != @$single_post->id)

                                    @php $i++; @endphp

                                    @if($i == 1 || $i == 3 || $i == 5 || $i == 7 || $i == 9)
                                        <tr>
                                    @endif
                                            <td valign="top" width="50%" class="padding-email">
                                                <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%">
                                                    <tr>
                                                        <td>
                                                            @if(isFileExist(@$post->image, @$post->image->thumbnail))

                                                            <img src="{{static_asset($post->image->thumbnail)}}" alt="" class="image-td">
                                                            @else
                                                                <img class="img-fluid" src="{{static_asset('default-image/default-240x160.png') }}"  alt="{!! $post->title !!}">
                                                            @endif

                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-services text-left">
                                                            <p class="meta"><span>{{__('posted_on')}} {{date('l, d F Y', strtotime($post->created_at))}}</span></p>
                                                            <h3>{{ $post->title }}</h3>
                                                            <p>{!! \Illuminate\Support\Str::limit($post->content, 40) !!}</p>
                                                            <p><a href="{{$base_url}}/{{settingHelper('article_detail_prefix') ?? 'article'}}/{{$post->slug}}" class="btn btn-primary">{{__('read_more')}}</a></p>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </td>
                                    @if($i == 2 || $i == 4 || $i == 6 || $i == 8 || $i == 10 || $posts->count() == $i)
                                        </tr>
                                    @endif
                                @endif
                            @endforeach
                        </table>
                    </td>
                </tr><!-- end: tr -->
            @else
                <tr>
                    <td class="bg_white email-section" align="center">
                        {{__('no_content_available')}}
                    </td>
                </tr>
        @endif

        <!-- 1 Column Text + Button : END -->
        </table>
        <table align="center" role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%" class="m-auto">
            <tr>
                <td valign="middle" class="bg_black footer email-section">
                    <table>
                        <tr>
                            <td valign="top" width="66.666%">
                                <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%">
                                    <tr>
                                        <td class="text-left pr-3">
                                            <p>{{settingHelper('copyright_text')}}</p>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                            <td valign="top" width="33.333%">
                                <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%">
                                    <tr>
                                        <td id="presentation">
                                            <p><a id="email_uns" href="{{$base_url}}/newsletter/unsubscribe/{{$user_id}}">Unsubcribe</a></p>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </div>
</center>
</body>
</html>

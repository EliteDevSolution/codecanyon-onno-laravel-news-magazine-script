<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office">
<head>
    <meta charset="utf-8"> <!-- utf-8 works for most cases -->
    <meta name="viewport" content="width=device-width"> <!-- Forcing initial-scale shouldn't be necessary -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge"> <!-- Use the latest (edge) version of IE rendering engine -->
    <meta name="x-apple-disable-message-reformatting">  <!-- Disable auto-scale in iOS 10 Mail entirely -->
    <title></title> <!-- The title tag shows in email notifications, like Android 4.4. -->
    <link href="https://fonts.googleapis.com/css?family=Work+Sans:200,300,400,500,600,700" rel="stylesheet">
    <!-- CSS Reset : BEGIN -->
    <link rel="stylesheet" href="{{static_asset('css/multi-email.css') }}">
    <!-- CSS Reset : END -->
</head>

<body width="100%" class="begin-body">
<center style="width: 100%; background-color: #f1f1f1;">
    <div id="diving">
        &zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;
    </div>
    <div class="email-container email-container-modify">
        <!-- BEGIN BODY -->
        <table align="center" role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%" class="m-auto">
            <tr>
                <td valign="top" class="bg_white bg-white-with">
                    <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%">
                        <tr>
                            <td class="logo text-left" width="20%">
                                <h1><a href="{{$base_url}}"><img src="{{ static_asset(settingHelper('logo')) }}" alt="{{ settingHelper('application_name') }}" width="100%"></a></h1>
                            </td>
                            <td class="text-left pl-4">{{ settingHelper('application_name') }}</td>
                        </tr>
                        @if(!blank($posts))
                            @foreach($posts as $post)
                                <tr><td colspan="2" class="text-center"><h2>{{__('post_title')}} - {{ $post->title }}</h2></td></tr>
                            @endforeach
                        @endif
                    </table>
                </td>
            </tr><!-- end tr -->
            @if(!blank($posts))
                @foreach($posts as $post)
                    <tr>
                        <td valign="middle" class="hero bg_white bg-white-modify" style="background-image: url({{ static_asset(@$post->image->original_image)}});">
                            <div class="overlay"></div>
                            <table>
                                <tr>
                                    <td>
                                        <div class="text text-center p-1">
                                            <h2>{{ $post->title }}</h2>
                                            <p>{!! \Illuminate\Support\Str::limit($post->content, 40) !!}</p>
                                            @if($post->post_type == 'article')
                                                <p><a href="{{$base_url}}/{{settingHelper('article_detail_prefix') ?? 'article'}}/{{$post->slug}}" class="btn btn-primary">{{__('read_more')}}</a></p>
                                            @else
                                                <div class="icon">
                                                    <a href="{{$base_url}}/{{settingHelper('article_detail_prefix') ?? 'article'}}/{{$post->slug}}">
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
                @endforeach
            @else
                <tr>
                    <td class="bg_white email-section" align="center">
                        <strong>{{__('no_content_available')}}</strong>
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
                                            <p><a id="email_uns" href="{{$base_url}}/newsletter/unsubscribe/{{$user->id}}" >Unsubcribe</a></p>
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

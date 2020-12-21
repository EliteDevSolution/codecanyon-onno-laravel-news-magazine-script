@if(Request::url() === url('/'))
    <meta name="title" content="{{ settingHelper('seo_title') }}" />
    <meta name="description" content="{{ settingHelper('seo_meta_description') }}" />
    <meta name="keywords" content="{{ settingHelper('seo_keywords') }}" />
    <meta name="author" content="{{ settingHelper('author_name') }}" />
    <meta name="language" content="{{ settingHelper('default_language') }}" />
    <link rel="canonical" href="{{ url('/') }}"/>
    <meta property="og:title" content="{{ settingHelper('og_title') }}" />
    <meta property="og:author" content="{{ settingHelper('author_name') }}" />
    <meta property="og:description" content="{{ strip_tags(\Illuminate\Support\Str::limit(settingHelper('og_description'), 130)) }}" />
    <meta property="og:locale" content="{{ settingHelper('default_language')}}" />
    <meta property="og:type" content="website" />
    <meta property="og:image:width" content="1200"/>
    <meta property="og:image:height" content="630"/>
    <meta property="og:url" content="{{ url('/') }}" />
    @if(settingHelper('og_image') != Null)
        <meta name="og:image" content="{{ asset(settingHelper('og_image')) }}" />
    @else
        <meta name="og:image" content="{{static_asset('default-image/default-730x400.png') }}" alt="{!! settingHelper('og_title') !!}" />
    @endif

    {{--        twitter--}}
    <meta name="twitter:title" content="{{ settingHelper('og_title') }}" />
    <meta name="twitter:description" content="{{ strip_tags(\Illuminate\Support\Str::limit(settingHelper('og_description'), 130)) }}" />
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:domain" content="{{ url('/') }}" />
    <meta name="twitter:url" content="{{ url('/') }}">
    @if(settingHelper('og_image') != Null)
        <meta name="twitter:image" content="{{ asset(settingHelper('og_image')) }}" />
    @else
        <meta name="twitter:image" content="{{static_asset('default-image/default-730x400.png') }}" alt="{!! settingHelper('og_title') !!}" />
    @endif
@endif

@if(!blank(\Request::route()))
    @if(\Request::route()->getName() == "article.detail")
        @if(isset($post))
            <title>{{ $post->title }}</title>
            <meta name="title" content="{{ $post->meta_title }}" />
            <meta name="description" content="{{ $post->meta_description }}" />
            <meta name="keywords" content="{{ $post->meta_keywords }}" />
            <meta name="news_keywords" content="{{ $post->tags }}"/>
            <meta name="author" content="{{ Sentinel::findById($post->user_id)->roles->first()->name }}" />
            <meta name="language" content="{{ $post->language }}" />
            <link rel="canonical" href="{{ route('article.detail', ['id' => $post->slug]) }}"/>
            <meta property="og:title" content="{{ $post->title }}" />
            <meta property="og:author" content="{{ Sentinel::findById($post->user_id)->roles->first()->name }}" />
            <meta property="og:description" content="{{ strip_tags(\Illuminate\Support\Str::limit($post->meta_description, 130)) }}" />
            <meta property="og:locale" content="{{ $post->language }}" />
            <meta property="og:type" content="article"/>
            <meta property="og:image:width" content="1200"/>
            <meta property="og:image:height" content="630"/>
            <meta property="og:url" content="{{ route('article.detail', ['id' => $post->slug]) }}" />

            @if(isFileExist(@$post->image, @$post->image->og_image))
                <meta name="og:image" content="{{basePath(@$post->image)}}/{{ @$post->image->og_image }}" alt="{!! $post->title !!}"/>
            @else
                <meta name="og:image" content="{{static_asset('default-image/default-730x400.png') }}" alt="{!! $post->title !!}"/>
            @endif
            {{--@endif--}}

            {{--        twitter--}}
            <meta name="twitter:title" content="{{ $post->title }}" />
            <meta name="twitter:description" content="{{ strip_tags(\Illuminate\Support\Str::limit($post->meta_description, 130)) }}" />
            <meta name="twitter:card" content="summary_large_image" />
            <meta name="twitter:domain" content="{{ url('/') }}" />
            <meta name="twitter:url" content="{{ route('article.detail', ['id' => $post->slug]) }}">
            
            @if(isFileExist(@$post->image, @$post->image->og_image))
                <meta name="twitter:image" content="{{basePath(@$post->image)}}/{{ @$post->image->og_image }}" alt="{!! $post->title !!}"/>
            @else
                <meta name="twitter:image" content="{{static_asset('default-image/default-730x400.png') }}" alt="{!! $post->title !!}"/>
            @endif
           {{-- @endif--}}
        @endif
    @endif
@endif

@if(!blank(\Request::route()))
    @if(\Request::route()->getName()== "site.page")
        <title>{{ $page->title }}</title>
        <meta name="title" content="{{ $page->meta_title }}" />
        <meta name="description" content="{{ $page->meta_description }}" />
        <meta name="keywords" content="{{ $page->meta_keywords }}" />

        <meta name="language" content="{{ $page->language }}" />
        <link rel="canonical" href="{{ route('site.page', ['slug' => $page->slug]) }}"/>
        <meta property="og:title" content="{{ $page->meta_title }}" />
        <meta property="og:description" content="{{ strip_tags(\Illuminate\Support\Str::limit($page->meta_description, 130)) }}" />
        <meta property="og:locale" content="{{ $page->language }}" />
        <meta property="og:type" content="article"/>
        <meta property="og:image:width" content="1200"/>
        <meta property="og:image:height" content="630"/>
        <meta property="og:url" content="{{ route('site.page', ['slug' => $page->slug]) }}" />
       @if(isFileExist(@$page->image, @$page->image->og_image))
            <meta name="og:image" content="{{basePath(@$page->image)}}/{{ @$page->image->og_image }}" alt="{!! $page->title !!}"/>
        @else
            <meta name="og:image" content="{{static_asset('default-image/default-730x400.png') }}" alt="{!! $page->title !!}"/>
        @endif

        {{--        twitter--}}
        <meta name="twitter:title" content="{{ $page->title }}" />
        <meta name="twitter:description" content="{{ strip_tags(\Illuminate\Support\Str::limit($page->meta_description, 130)) }}" />
        <meta name="twitter:card" content="summary_large_image" />
        <meta name="twitter:domain" content="{{ url('/') }}" />
        <meta name="twitter:url" content="{{ route('site.page', ['slug' => $page->slug]) }}">
        @if(isFileExist(@$page->image, @$page->image->og_image))
            <meta name="twitter:image" content="{{basePath(@$page->image)}}/{{ @$page->image->og_image }}" alt="{!! $page->title !!}"/>
        @else
            <meta name="twitter:image" content="{{static_asset('default-image/default-730x400.png') }}" alt="{!! $page->title !!}"/>
        @endif
    @endif
@endif

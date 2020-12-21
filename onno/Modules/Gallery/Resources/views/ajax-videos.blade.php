@foreach ($videos as $video)
    <div class="col-md-2 " id="row_{{ $video->id }}">

        @if(isFileExist(@$video, @$video->video_thumbnail))
            <img id='{{ $video->id }}' src="{{basePath($video)}}/{{ $video->video_thumbnail }}" alt="video"
                 class="video img-responsive img-thumbnail">
        @else
            <img id='{{ $video->id }}' src="{{static_asset('default-image/default-video-100x100.png') }}" alt="video"
                 class="video img-responsive img-thumbnail">
        @endif

        <label class="video_lvl" for="{{ $video->id }}">{{ $video->video_name }}</label>
    </div>
@endforeach

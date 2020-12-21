<ul class="@if(isset($is_children) && $is_children) children @else comment-list @endif global-list">
    @foreach($comments as $comment)
        <li class="media">
            <div class="commenter-avatar">
                <a href="#"><img class="img-fluid" src="{{static_asset('site/images/others/author.png') }}" alt="Image"></a>
            </div>
            <div class="comment-box media-body">
                <div class="comment-meta">
                    <span class="title"><a href="#" class="url">{{ data_get($comment, 'user.name') }}</a> <span class="sg-date">{{ $diff = Carbon\Carbon::parse($comment->created_at)->diffForHumans() }}</span></span>
                </div>
                <div class="comment-content">
                    <p>{{ $comment->comment ?? '' }}</p>
                </div>
                <form class="contact-form" name="contact-form" method="post" action="{{ route('article.save.reply') }}">
                    @csrf
                    <input type="hidden" name="post_id" value="{{ $comment->post_id ?? '' }}">
                    <input type="hidden" name="comment_id" value="{{ $comment->id }}">
                    <div class="row">
                        <div class="col-lg-8">
                            <div class="form-group">
                                <input type="text" name="comment" class="form-control" required="required" id="one" placeholder="{{__('reply')}}">
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <button type="submit" class="btn btn-primary">{{ __('reply') }}</button>
                        </div>
                    </div>
                </form>
            </div>

            @if(!blank($reply = data_get($comment, 'reply')))
                @include('site.post.comment', [
                    'comments' => $reply,
                    'is_children' => true,
                ])
            @endif
        </li>
    @endforeach
</ul>

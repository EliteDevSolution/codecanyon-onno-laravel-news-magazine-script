@if($customMessage == "")

    @if($bulk_email_type == "")
        @include('email.single_post', ['posts' => $posts])
    @else
        @include('email.multiple_post', ['posts' => $posts, 'bulk_email_type' => $bulk_email_type])
    @endif
@else
    <p>{!! $customMessage !!}</p>
@endif

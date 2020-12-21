<div class="col-lg-4">
    <div class="footer-widget">
        <h3>{{ data_get($detail, 'title') }}</h3>
        <p>{{ __('subscribe_description') }}</p>
        <form action="{{ route('subscribe.newsletter') }}" class="tr-form" method="POST">
            @csrf
            <input name="email" type="email" class="form-control" placeholder="{{__('email_address')}}" required>
            <button type="submit" class="btn btn-primary">{{ __('subscribe') }}</button>
        </form>
    </div>
</div>

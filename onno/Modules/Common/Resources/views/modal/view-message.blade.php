@php
    $message= Modules\Contact\Entities\ContactMessage::findOrFail($param[0]);
    $message->message_seen=1;
    $message->save();
@endphp

<div class="modal-body">
    <div class="row">
        <label for="name" class="col-form-label col-md-12"><b>{{ $message->name }}</b> {{ $message->email }}</label>
        <div class="col-md-12">
            <textarea disabled rows="10" class="form-control">{!! $message->message !!}</textarea>
        </div>
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-light" data-dismiss="modal">{{ __('close') }}</button>
</div>

{!!  Form::open(['route' => 'store-tag', 'method' => 'post']) !!}

<div class="modal-body">
    <div class="form-group">
        <label for="tag" class="col-form-label"><b>{{ __('title') }}</b></label>
        <input id="tag" name="tag" type="text" required class="form-control">
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="m-r-10 fas fa-window-close"></i>{{ __('close') }}</button>
    <button type="submit" class="btn btn-primary"><i class="m-r-10 mdi mdi-content-save-all"></i>{{ __('save') }}</button>
</div>

{{ Form::close() }}

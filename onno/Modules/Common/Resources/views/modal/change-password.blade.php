{!!  Form::open(['route' => 'change-password-by-me', 'method' => 'post']) !!}

    <div class="modal-body">
        <div class="form-group">
            <label for="name" class="col-form-label"><b>{{ __('old_password') }}</b></label>
            <input id="old_password" name="old_password" type="password" required class="form-control">
        </div>

        <div class="form-group">
            <label for="password" class="col-form-label"><b>{{ __('new_password') }}</b></label>
            <input id="password" name="password" type="password" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="description" class="col-form-label"><b>{{ __('confirm_password') }}</b></label>
            <input id="password" name="password_confirmation" type="password" class="form-control"
                   data-parsley-equalto="#password" required>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="m-r-10 fas fa-window-close"></i>{{ __('close') }}</button>
        <button type="submit" class="btn btn-primary"><i class="m-r-10 mdi mdi-content-save-all"></i>{{ __('save') }}</button>
    </div>

{{ Form::close() }}

@php
    $roles= Modules\User\Entities\Role::allRole();
@endphp

{!!  Form::open(['route' => ['change-role',$param[0],$param[1]], 'method' => 'post','enctype'=>'multipart/form-data']) !!}

          <div class="modal-body">
              <div class="form-group">
                  <label for="recipient-name" class="col-form-label">{{ __('role') }}</label>
                  <select class="form-control" name="slug">
                      @foreach ($roles as $role)
                          <option value="{{ $role->slug }}">{{ $role->name }}</option>
                      @endforeach
                  </select>
              </div>
          </div>
          <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="m-r-10 fas fa-window-close"></i>{{ __('close') }}</button>
              <button type="submit" class="btn btn-primary"><i class="m-r-10 mdi mdi-content-save-all"></i>{{ __('save_changes') }}</button>
          </div>

{{ Form::close() }}

@php
    $user= Modules\User\Entities\User::find($param[0]);
@endphp

{!!  Form::open(['route' => ['update-user-info',$param[0]], 'method' => 'post','enctype'=>'multipart/form-data']) !!}
    <div class="modal-body">

        <div class="form-group">
            <label for="first_name" class="col-form-label">{{ __('first_name') }}</label>
            <input id="first_name" name="first_name" value="{{ $user->first_name }}" type="text" class="form-control">
        </div>
        <div class="form-group">
            <label for="last_name" class="col-form-label">{{ __('last_name') }}</label>
            <input id="last_name" name="last_name" value="{{ $user->last_name }}" type="text" class="form-control">
        </div>
        <div class="form-group">
            <label for="email" class="col-form-label">{{ __('email') }}</label>
            <input id="email" disabled value="{{ $user->email }}" type="email" class="form-control">
        </div>
        <div class="form-group">
            <label for="newsletter" class="col-form-label">{{ __('newsletter') }}</label>
            <select name="newsletter_enable" class="form-control">
                <option value="0" @if($user->newsletter_enable==0) selected @endif>{{ __('disable') }}</option>
                <option value="1" @if($user->newsletter_enable==1) selected @endif>{{ __('enable') }}</option>
            </select>
        </div>

        <div class="form-group">
            <button type="button" id="btn_image_modal" class="btn btn-primary btn-image-modal" data-id="1" data-toggle="modal" data-target=".image-modal-lg">{{ __('add_image') }}</button>
            <input id="image_id" name="image_id" type="hidden" class="form-control">
        </div>
        @if(isFileExist($user->image, @$user->image->small_image))
            <div class="form-group text-center">
                <img src=" {{basePath($user->image)}}/{{ $user->image->small_image }} " id="image_preview" width="200" height="200" alt="user" class="img-responsive img-thumbnail"  >
            </div>
        @else
            <div class="form-group text-center">
                <img src="{{static_asset('default-image/user.jpg') }} "  id="image_preview" width="200" height="200" alt="user" class="img-responsive img-thumbnail" >
            </div>
        @endif
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="m-r-10 fas fa-window-close"></i>{{ __('close') }}</button>
        <button type="submit" class="btn btn-primary"><i class="m-r-10 mdi mdi-content-save-all"></i>{{ __('save') }}</button>
    </div>
{{ Form::close() }}

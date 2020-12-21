@extends('site.layouts.app')

@section('content')
<div class="container-fluid ">
	<div class="text-center my-5">
	    <div class="error mx-auto">{{ __('500') }}</div>
	    <p class="lead text-gray-800 mb-5">{{ __('server_error') }}</p>
	    <p class="text-gray-500 mb-0">{{ __('500_message') }} </p>
	    <a href="{{ url('') }}">← {{ __('back_to_home') }}</a>
	 </div>
</div>
@endsection
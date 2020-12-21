@php
$headerWidgets = data_get($widgets, \Modules\Widget\Enums\WidgetLocation::HEADER, []);
@endphp

@if(data_get(activeTheme(), 'options.header_style') == 'header_1')
    @include('site.layouts.header.style_1', ['headerWidgets' => $headerWidgets])
@elseif(data_get(activeTheme(), 'options.header_style') == 'header_2')
    @include('site.layouts.header.style_2', ['headerWidgets' => $headerWidgets])
@elseif(data_get(activeTheme(), 'options.header_style') == 'header_3')
    @include('site.layouts.header.style_3', ['headerWidgets' => $headerWidgets])
@endif


@if(data_get(activeTheme(), 'options.header_style') != 'header_1')
<div class="container">
    <div class="row">
        <div class="col-12">
            @if(session('error'))
                <div id="error_m" class="alert alert-danger">
                    {{session('error')}}
                </div>
            @endif
            @if(session('success'))
                <div id="success_m" class="alert alert-success">
                    {{session('success')}}
                </div>
            @endif
            @if(isset($errors))
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            @endif
        </div>
    </div>
</div>
@endif

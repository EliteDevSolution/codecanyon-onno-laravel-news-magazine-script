@php
    $rightWidgets = data_get($widgets, \Modules\Widget\Enums\WidgetLocation::RIGHT_SIDEBAR, []);
@endphp

@foreach($rightWidgets as $widget)
    @php
        //dd($widget['view']);
        $viewFile = 'site.widgets.'.$widget['view'];
    @endphp
    @if(view()->exists($viewFile))
        @include($viewFile, $widget)
    @endif
@endforeach

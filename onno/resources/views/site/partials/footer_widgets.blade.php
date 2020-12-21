@php
    $footerWidgets = data_get($widgets, \Modules\Widget\Enums\WidgetLocation::FOOTER, []);
@endphp

@foreach($footerWidgets as $widget)
    @php $viewFile = 'site.widgets.footer.'.$widget['view'] @endphp
    @if(view()->exists($viewFile))
        @include($viewFile, $widget)
    @endif
@endforeach

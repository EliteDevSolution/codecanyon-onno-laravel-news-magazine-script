@if(!blank($section))
    @php 
    $posts = $posts->where('visibility', 1)
    	->where('status', 1);
    	
    $viewFile = 'site.partials.home.primary.'.$section->section_style ?? 'style_1'; @endphp

    @if(view()->exists($viewFile))
        @include($viewFile, ['posts' => $posts, 'breakingNewss' => $breakingNewss, 'language' => $language])
    @endif
@endif

<ul class="pagination justify-content-center">
    @if ($paginator->hasPages())
        @if(!$paginator->onFirstPage())
            <li><a class="page-numbers" href="{{ $paginator->previousPageUrl() }}"><i class="fa fa-angle-left"
                                                                                      aria-hidden="true"></i></a></li>
        @endif
        <li class="active"><a class="page-numbers" href="javascript:void(0)">{{ $paginator->currentPage() }}</a></li>
        @if ($paginator->hasMorePages())
            <li><a class="page-numbers" href="{{ $paginator->nextPageUrl() }}"><i class="fa fa-angle-right"
                                                                                  aria-hidden="true"></i></a></li>
        @endif
    @endif
</ul>


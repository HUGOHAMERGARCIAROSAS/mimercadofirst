<div class="pagination-container">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="pagination-content text-center">
                    @if ($paginator->lastPage() > 1)
                    <ul>
                        @if ($paginator->onFirstPage())
                        <li><a href="#" class="prev">&lt;</a></li>
                        @else
                        <li>
                            <a href="{{ $paginator->previousPageUrl() }}" class="prev">&lt;</a>
                        </li>
                        @endif

                        @for ($i = 1; $i <= $paginator->lastPage(); $i++)
                        <li>
                            <a href="{{ $paginator->url($i) }}"
                               class="{{ ($paginator->currentPage() == $i) ? ' active' : '' }}">
                                {{ $i }}
                            </a>
                        </li>
                        @endfor

                        @if ($paginator->hasMorePages())
                        <li>
                            <a href="{{ $paginator->nextPageUrl() }}" class="next">&gt;</a>
                        </li>
                        @else
                        <li class="disabled"><a href="#" class="next">&gt;</a></li>
                        @endif
                    </ul>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
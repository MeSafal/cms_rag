

@if ($paginator->hasPages())
    <div class="d-flex justify-content-between align-items-center mt-3">
        <!-- Showing Results Text -->
        <div>
            <p class="mb-0" style="color: #6C7293;">
                Showing
                <span style="color: #EB1616; font-weight: bold;">{{ $paginator->firstItem() }}</span>
                to
                <span style="color: #EB1616; font-weight: bold;">{{ $paginator->lastItem() }}</span>
                of
                <span style="color: #EB1616; font-weight: bold;">{{ $paginator->total() }}</span>
                results
            </p>
        </div>

        <!-- Pagination -->
        <nav>
            <ul class="pagination mb-0">
                {{-- Previous Page Link --}}
                @if ($paginator->onFirstPage())
                    <li class="page-item disabled">
                        <span class="page-link" style="background-color: #6C7293; color: white; border: none;">&laquo; </span>
                    </li>
                @else
                    <li class="page-item">
                        <a class="page-link" href="{{ $paginator->previousPageUrl() }}" style="background-color: #6C7293; color: white; border: none;">&laquo; </a>
                    </li>
                @endif

                @if ($elements)

                {{-- Pagination Elements --}}
                @foreach ($elements as $element)
                    @if (is_string($element))
                        {{-- "Three Dots" Separator --}}
                        <li class="page-item disabled">
                            <span class="page-link" style="background-color: #6C7293; color: white; border: none;">{{ $element }}</span>
                        </li>
                    @endif

                    @if (is_array($element))
                        @php
                            $totalPages = $paginator->lastPage();
                            $currentPage = $paginator->currentPage();
                            $visiblePages = $totalPages > 8 ? 8 : $totalPages; // Show up to 8 pages
                        @endphp

                        @foreach ($element as $page => $url)
                            @if (
                                $page == 1 ||
                                $page == $totalPages ||
                                ($page >= $currentPage - 2 && $page <= $currentPage + 2) ||
                                ($totalPages <= 8)
                            )
                                @if ($page == $paginator->currentPage())
                                    <li class="page-item active" aria-current="page">
                                        <span class="page-link" style="background-color: #EB1616; color: white; border: none;">{{ $page }}</span>
                                    </li>
                                @else
                                    <li class="page-item">
                                        <a class="page-link" href="{{ $url }}" style="background-color: #6C7293; color: white; border: none;">{{ $page }}</a>
                                    </li>
                                @endif
                            @elseif ($page == $currentPage - 3 || $page == $currentPage + 3)
                                {{-- Add dots when skipping pages --}}
                                <li class="page-item disabled">
                                    <span class="page-link" style="background-color: #6C7293; color: white; border: none;">&hellip;</span>
                                </li>
                            @endif
                        @endforeach
                    @endif
                @endforeach

                @endif
                {{-- Next Page Link --}}
                @if ($paginator->hasMorePages())
                    <li class="page-item">
                        <a class="page-link" href="{{ $paginator->nextPageUrl() }}" style="background-color: #6C7293; color: white; border: none;"> &raquo;</a>
                    </li>
                @else
                    <li class="page-item disabled">
                        <span class="page-link" style="background-color: #6C7293; color: white; border: none;"> &raquo;</span>
                    </li>
                @endif
            </ul>
        </nav>
    </div>
@endif


<style>
@media (max-width: 576px) {
    .pagination .page-item {
        display: none;
    }
    .pagination .page-item.active,
    .pagination .page-item:first-child,
    .pagination .page-item:last-child,
    .pagination .page-item:nth-child(2),
    .pagination .page-item:nth-last-child(2) {
        display: inline-block;
    }
}

</style>
<script>
    document.querySelectorAll('.pagination a').forEach(link => {
    link.addEventListener('click', function(e) {
        window.location.href = this.href;
    });
});

</script>

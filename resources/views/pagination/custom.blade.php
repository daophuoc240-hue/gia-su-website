@if ($paginator->hasPages())
    <div class="custom-pagination-wrapper">
        <div class="pagination-info">
            Hiển thị từ <strong>{{ $paginator->firstItem() }}</strong> đến <strong>{{ $paginator->lastItem() }}</strong> trong tổng số <strong>{{ $paginator->total() }}</strong> bản ghi
        </div>
        <nav aria-label="Chuyển trang">
            <ul class="custom-pagination">
                {{-- Nút trang trước --}}
                @if ($paginator->onFirstPage())
                    <li class="page-item disabled" aria-disabled="true">
                        <span class="page-link"><i class="fas fa-chevron-left" style="font-size:0.75rem;"></i> Trước</span>
                    </li>
                @else
                    <li class="page-item">
                        <a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev"><i class="fas fa-chevron-left" style="font-size:0.75rem;"></i> Trước</a>
                    </li>
                @endif

                {{-- Các trang số --}}
                @foreach ($elements as $element)
                    @if (is_string($element))
                        <li class="page-item disabled" aria-disabled="true"><span class="page-link">{{ $element }}</span></li>
                    @endif

                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            @if ($page == $paginator->currentPage())
                                <li class="page-item active" aria-current="page"><span class="page-link">{{ $page }}</span></li>
                            @else
                                <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                            @endif
                        @endforeach
                    @endif
                @endforeach

                {{-- Nút trang sau --}}
                @if ($paginator->hasMorePages())
                    <li class="page-item">
                        <a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next">Sau <i class="fas fa-chevron-right" style="font-size:0.75rem;"></i></a>
                    </li>
                @else
                    <li class="page-item disabled" aria-disabled="true">
                        <span class="page-link">Sau <i class="fas fa-chevron-right" style="font-size:0.75rem;"></i></span>
                    </li>
                @endif
            </ul>
        </nav>
    </div>
@endif

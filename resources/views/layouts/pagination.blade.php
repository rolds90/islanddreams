@if ($paginator->hasPages())
  <ul class="pagination">
    {{-- Previous Page Link --}}
    @if ($paginator->onFirstPage())
    <li class="disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
      <span aria-hidden="true">Prev</span>
    </li>
    @else
    <li>
      <a href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')">Prev</a>
    </li>
    @endif

    {{-- Pagination Elements --}}
    @foreach ($elements as $element)
      {{-- "Three Dots" Separator --}}
      @if (is_string($element))
      <li class="disabled">
        <span>...</span>
      </li>
      @endif

      {{-- Array Of Links --}}
      @if (is_array($element))
        @foreach ($element as $page => $url)
          @if ($page == $paginator->currentPage())
          <li class="active" aria-current="page"><a href="#">{{ $page }}</a></li>
          @else
          <li><a href="{{ $url }}">{{ $page }}</a></li>
          @endif
        @endforeach
      @endif
    @endforeach

    @if ($paginator->hasMorePages())
    <li>
      <a href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')">Next</a>
    </li>
    @else
    <li class="disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
      <span aria-hidden="true">Next</span>
    </li>
    @endif
  </ul>
@endif
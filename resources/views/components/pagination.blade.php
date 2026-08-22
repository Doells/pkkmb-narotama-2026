@php
    $firstItem = $paginator->firstItem() ?? 0;
    $lastItem = $paginator->lastItem() ?? 0;
@endphp

<nav role="navigation" aria-label="Navigasi halaman" class="cine-pg-pagination">
    @if (isset($perPageValues) && count($perPageValues) > 1)
        <div class="cine-pg-per-page">
            <label for="cine-per-page-{{ $paginator->getPageName() }}">Tampilkan</label>
            <select id="cine-per-page-{{ $paginator->getPageName() }}"
                wire:model.lazy="setUp.footer.perPage"
                aria-label="Jumlah data per halaman">
                @foreach ($perPageValues as $value)
                    <option value="{{ $value }}">{{ $value }}</option>
                @endforeach
            </select>
            <span>data</span>
        </div>
    @endif

    <p class="cine-pg-summary" aria-live="polite">
        Menampilkan
        <strong>{{ $firstItem }}</strong>
        sampai
        <strong>{{ $lastItem }}</strong>
        dari
        <strong>{{ $paginator->total() }}</strong>
        data
    </p>

    @if ($paginator->hasPages())
        <div class="cine-pg-pages">
            @if ($paginator->onFirstPage())
                <span class="cine-pg-page is-disabled" aria-disabled="true" aria-label="Halaman sebelumnya">
                    <span aria-hidden="true">&lsaquo;</span>
                </span>
            @else
                <button type="button" class="cine-pg-page" wire:click="previousPage('{{ $paginator->getPageName() }}')"
                    wire:loading.attr="disabled" rel="prev" aria-label="Halaman sebelumnya">
                    <span aria-hidden="true">&lsaquo;</span>
                </button>
            @endif

            @foreach ($elements as $element)
                @if (is_string($element))
                    <span class="cine-pg-page is-separator" aria-hidden="true">{{ $element }}</span>
                @endif

                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <span class="cine-pg-page is-active" aria-current="page">{{ $page }}</span>
                        @else
                            <button type="button" class="cine-pg-page"
                                wire:click="gotoPage({{ $page }}, '{{ $paginator->getPageName() }}')"
                                wire:loading.attr="disabled" aria-label="Ke halaman {{ $page }}">
                                {{ $page }}
                            </button>
                        @endif
                    @endforeach
                @endif
            @endforeach

            @if ($paginator->hasMorePages())
                <button type="button" class="cine-pg-page" wire:click="nextPage('{{ $paginator->getPageName() }}')"
                    wire:loading.attr="disabled" rel="next" aria-label="Halaman berikutnya">
                    <span aria-hidden="true">&rsaquo;</span>
                </button>
            @else
                <span class="cine-pg-page is-disabled" aria-disabled="true" aria-label="Halaman berikutnya">
                    <span aria-hidden="true">&rsaquo;</span>
                </span>
            @endif
        </div>
    @endif
</nav>

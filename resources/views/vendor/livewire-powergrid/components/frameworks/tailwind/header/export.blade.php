<div x-data="{ open: false }" class="cine-pg-tool" @click.outside="open = false">
    <button type="button" class="cine-pg-icon-button" @click.prevent="open = !open"
        :aria-expanded="open.toString()" aria-label="Ekspor data" title="Ekspor data">
        <x-livewire-powergrid::icons.download class="h-5 w-5" />
    </button>

    <div x-show="open" x-cloak x-transition class="cine-pg-popover cine-pg-export">
        @if (in_array('excel', data_get($setUp, 'exportable.type')))
            <div class="cine-pg-export-row">
                <strong>Excel</strong>
                <a href="#" x-on:click.prevent="$wire.call('exportToXLS'); open = false">
                    @lang('livewire-powergrid::datatable.labels.all')
                </a>
                @if ($checkbox)
                    <a href="#" x-on:click.prevent="$wire.call('exportToXLS', true); open = false">
                        @lang('livewire-powergrid::datatable.labels.selected')
                    </a>
                @endif
            </div>
        @endif

        @if (in_array('csv', data_get($setUp, 'exportable.type')))
            <div class="cine-pg-export-row">
                <strong>CSV</strong>
                <a href="#" x-on:click.prevent="$wire.call('exportToCsv'); open = false">
                    @lang('livewire-powergrid::datatable.labels.all')
                </a>
                @if ($checkbox)
                    <a href="#" x-on:click.prevent="$wire.call('exportToCsv', true); open = false">
                        @lang('livewire-powergrid::datatable.labels.selected')
                    </a>
                @endif
            </div>
        @endif
    </div>
</div>

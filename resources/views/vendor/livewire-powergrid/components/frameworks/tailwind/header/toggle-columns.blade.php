@if (data_get($setUp, 'header.toggleColumns'))
    <div x-data="{ open: false }" class="cine-pg-tool mr-0 sm:mr-2" @click.outside="open = false">
        <button type="button" class="cine-pg-icon-button" @click.prevent="open = !open"
            :aria-expanded="open.toString()" aria-label="Atur kolom" title="Atur kolom">
            <x-livewire-powergrid::icons.eye-off class="h-5 w-5" />
        </button>

        <div x-show="open" x-cloak x-transition class="cine-pg-popover cine-pg-columns">
            <p class="cine-pg-popover-title">Tampilkan kolom</p>
            @foreach ($columns as $column)
                @if (!$column->forceHidden)
                    <button type="button"
                        wire:click="$emit('pg:toggleColumn-{{ $tableName }}', '{{ $column->field }}')"
                        wire:key="toggle-column-{{ $column->field }}"
                        class="cine-pg-column-option {{ $column->hidden ? 'is-hidden' : 'is-visible' }}">
                        @if (!$column->hidden)
                            <x-livewire-powergrid::icons.eye class="h-5 w-5" />
                        @else
                            <x-livewire-powergrid::icons.eye-off class="h-5 w-5" />
                        @endif
                        <span>{!! $column->title !!}</span>
                    </button>
                @endif
            @endforeach
        </div>
    </div>
@endif

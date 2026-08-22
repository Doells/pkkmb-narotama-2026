@inject('helperClass','PowerComponents\LivewirePowerGrid\Helpers\Helpers')
@php
    $parameters = $action->singleParam
        ? $helperClass->makeActionParameter($action->params)
        : $helperClass->makeActionParameters($action->params);
    $requiresDeleteConfirmation = str_contains($action->class, 'cine-bulk-delete');
@endphp

@if($action->event !== '' && $action->to === '')
    <button
        type="button"
        wire:click='$emit("{{ $action->event }}", @json($parameters))'
        @if($requiresDeleteConfirmation)
            onclick="if (!confirm('Hapus semua data yang dipilih? Tindakan ini tidak dapat dibatalkan.')) { event.preventDefault(); event.stopImmediatePropagation(); return false; }"
        @endif
        title="{{ $action->tooltip }}"
        id="{{ $action->id }}"
        class="power-grid-button {{ filled($action->class) ? $action->class : $theme->actions->headerBtnClass }}">
        {!! $action->caption !!}
    </button>
@elseif($action->event !== '' && $action->to !== '')
    <button
        type="button"
        wire:click='$emitTo("{{ $action->to }}", "{{ $action->event }}", @json($parameters))'
        title="{{ $action->tooltip }}"
        id="{{ $action->id }}"
        class="power-grid-button {{ filled($action->class) ? $action->class : $theme->actions->headerBtnClass }}">
        {!! $action->caption !!}
    </button>
@elseif($action->view !== '')
    <button type="button" wire:click='$emit("openModal", "{{$action->view}}", @json($parameters))'
        title="{{ $action->tooltip }}" id="{{ $action->id }}"
        class="power-grid-button {{ filled($action->class) ? $action->class : $theme->actions->headerBtnClass }}">
        {!! $action->caption !!}
    </button>
@else
    @if(strtolower($action->method) !== 'get')
        <form target="{{ $action->target }}" action="{{ route($action->route, $parameters) }}" method="{{ $action->method }}">
            @method($action->method)
            @csrf
            <button type="submit" id="{{ $action->id }}" title="{{ $action->tooltip }}"
                class="power-grid-button {{ filled($action->class) ? $action->class : $theme->actions->headerBtnClass }}">
                {!! $action->caption ?? '' !!}
            </button>
        </form>
    @elseif(data_get($action, 'route'))
        <a href="{{ route($action->route, $parameters) }}" id="{{ $action->id }}" title="{{ $action->tooltip }}"
            target="{{ $action->target }}"
            class="power-grid-button {{ filled($action->class) ? $action->class : $theme->actions->headerBtnClass }}">
            {!! $action->caption !!}
        </a>
    @endif
@endif

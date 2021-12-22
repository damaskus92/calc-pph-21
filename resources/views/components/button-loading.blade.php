@php
if (isset($attributes['wire:click.prevent'])) {
    $target = $attributes['wire:click.prevent'];
} elseif (isset($attributes['wire:click'])) {
    $target = $attributes['wire:click'];
}
@endphp

<button {{ $attributes->merge(['type' => 'button', 'class' => 'btn btn-loading']) }}>
    <div wire:loading wire:loading.class="show-loading" wire:target="{{ $target }}">
        <span class="spinner-border spinner-border-sm"></span>
    </div>

    <span wire:loading.class="hide-label" wire:target="{{ $target }}">{{ $slot }}</span>
</button>

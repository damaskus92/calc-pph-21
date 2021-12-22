@props(['disabled' => false, 'readonly' => false])

<div x-data="{ value: @entangle($attributes->wire('model')) }" x-init="() => {}">
    <input x-ref="input" {{ $disabled ? 'disabled' : '' }} {{ $readonly ? 'readonly' : '' }} {!! $attributes->merge(['class' => 'form-control text-end']) !!} onClick="this.select();" />
</div>

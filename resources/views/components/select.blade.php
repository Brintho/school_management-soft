@props(['name', 'id' => null, 'label' => null, 'value' => null, 'options' => [], 'placeholder' => null])

<div class="mb-3 {{ $attributes->get('class') }}">
    @if ($label)
        <label for="{{ $id ?? $name }}" class="form-label @if ($attributes->has('required')) required @endif">
            {{ $label }}
        </label>
    @endif

    <select id="{{ $id ?? $name }}" name="{{ $name }}" class="custom-selectTo form-select">
        @if ($placeholder)
            <option value="">{{ $placeholder }}</option>
        @endif

        @foreach ($options as $key => $option)
            <option value="{{ $key }}" @selected($attributes->get('data-value') == $key)>{{ $option }}</option>
        @endforeach
    </select>
</div>

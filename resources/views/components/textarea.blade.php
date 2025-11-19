@props(['type' => 'text', 'name', 'id' => null, 'label' => null, 'autocomplete' => null, 'value' => null])

<div class="mb-3 @if ($attributes->has('class')) {{ $attributes->get('class') }} @endif">
    @if ($label)
        <label for="{{ $id ?? $name }}" class="form-label @if ($attributes->has('required')) required @endif">
            {{ $label }}
        </label>
    @endif

    <textarea name="{{ $name }}" id="{{ $id ?? $name }}"
        {{ $attributes->merge(['class' => 'form-control' . ($errors->has($name) ? ' is-invalid' : '')]) }}
        autocomplete="{{ $autocomplete ?? $name }}">{{ $value }}</textarea>

    @error($name)
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>

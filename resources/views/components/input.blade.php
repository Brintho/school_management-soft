@props(['type' => 'text', 'name', 'id' => null, 'label' => null, 'autocomplete' => null, 'note' => null])

<div class="mb-3 @if ($attributes->has('class')) {{ $attributes->get('class') }} @endif">
    @if ($label)
        <label for="{{ $id ?? $name }}" class="form-label @if ($attributes->has('required')) required @endif">
            {{ $label }} <small class="text-muted">{{ $note }}</small>
        </label>
    @endif

    <input type="{{ $type }}" name="{{ $name }}" id="{{ $id ?? $name }}" {{ $attributes->merge(['class' => 'form-control' . ($errors->has($name) ? ' is-invalid' : '')]) }} autocomplete="{{ $autocomplete ?? $name }}" value="{{ $attributes->get('data-value') }}">

    @error($name)
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror

</div>

@props(['title', 'url', 'size', 'icon', 'class'])

<button type="button" data-modal="modal" data-url="{{ $url }}" data-title="{{ translate($title) }}"
    @isset($size) data-size="{{ $size }}" @endisset
    class="@isset($class) {{ $class }} @else btn btn-dark @isset($icon) d-flex align-items-center gap-1 @endisset @endisset">
    <i class="@isset($icon) {{ $icon ?? 'fi fi-rr-multiple' }} @endisset"></i>
    {{ translate($title) }}
</button>

@props(['title' => null, 'url', 'size', 'icon'])

<button type="button" data-modal="r-canvas" data-url="{{ $url }}" data-title="{{ translate($title) }}" @isset($size) data-size="{{ $size }}" @endisset class="btn btn-dark @isset($icon) d-flex align-items-center gap-1 @endisset">
    <i class="@isset($icon) {{ $icon ?? 'fi fi-rr-multiple' }} @endisset"></i>
    {{ translate($title) }}
</button>

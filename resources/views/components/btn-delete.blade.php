@props(['url', 'title', 'class', 'icon'])

<button type="button" data-modal="delete" data-url="{{ $url }}" class="@isset($class) {{ $class }} @else btn btn-dark @endisset">
    @isset($icon)
        <i class="{{ $icon }}"></i>
    @else
        <i class="fi fi-rr-trash"></i>
    @endisset

    @isset($title)
        <span>{{ $title }}</span>
    @else
        <span>{{ translate('Delete') }}</span>
    @endisset
</button>

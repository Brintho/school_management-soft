@props(['url', 'title', 'class', 'icon', 'divider'])

<li @isset($divider)class="divider"@endisset>
    <button type="button" data-modal="delete" data-url="{{ $url }}" class="dropdown-item delete">
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
</li>

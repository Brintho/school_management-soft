@props(['title', 'url', 'icon', 'divider'])

<li @isset($divider)class="divider"@endisset>
    <a href="{{ $url }}" class="dropdown-item">
        <i class="@isset($icon) {{ $icon ?? 'fi fi-rr-multiple' }} @endisset"></i>
        {{ translate($title) }}
    </a>
</li>

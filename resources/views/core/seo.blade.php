@php
    $seo = App\Services\SeoService::generatePageSeo();
@endphp

<title>{{ $seo->meta_title ?? config('app.name') }}</title>
<meta name="description" content="{{ $seo->meta_description ?? '' }}">
<meta name="keywords" content="{{ $seo->meta_keywords ?? '' }}">
<meta name="robots" content="{{ $seo->meta_robot ?? 'index, follow' }}">
<meta name="author" content="Creativeitem">
<meta name="publisher" content="Creativeitem">


<link rel="canonical" href="{{ $seo->canonical_url ?? url()->current() }}" />
@if (!empty($seo->custom_url))
    <link rel="custom" href="{{ $seo->custom_url }}" />
@endif


<meta name="mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-title" content="{{ config('app.name') }}">


<!-- Open Graph Meta Tags -->
<meta property="og:title" content="{{ $seo->og_title ?? $seo->meta_title }}" />
<meta property="og:description" content="{{ $seo->og_description ?? $seo->meta_description }}" />
<meta property="og:image" content="{{ $seo->og_image ?? asset('default-og-image.jpg') }}" />
<meta property="og:url" content="{{ url()->current() }}" />
<meta property="og:type" content="website" />
<meta property="og:site_name" content="{{ config('app.name') }}">
<meta property="og:locale" content="{{ str_replace('_', '-', app()->getLocale()) }}">


<!-- Twitter Meta Tags -->
<meta name="twitter:card" content="summary">
<meta name="twitter:title" content="{{ $seo->og_title ?? $seo->meta_title }}">
<meta name="twitter:description" content="{{ $seo->meta_description }}">
<meta name="twitter:image" content="{{ $seo->og_image ?? asset('default-twitter-image.jpg') }}">
<meta name="twitter:site" content="@creativeitem">
<meta name="twitter:creator" content="@creativeitem">


<!-- JSON-LD Structured Data -->
@if (!empty($seo->json_data))
    <script type="application/ld+json">
        {!! $seo->json_data !!}
    </script>
@endif

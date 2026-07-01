<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#021F57">
    <script>document.documentElement.className = 'js';</script>

    @php
        $site = config('site');
        $pageTitle = trim($__env->yieldContent('title'));
        $title = $pageTitle ? $pageTitle . ' | ' . $site['agent'] . ' — ' . $site['company'] : $site['agent'] . ' — ' . $site['company'] . ' Agent in ' . $site['city'] . ', MI';
        $desc = trim($__env->yieldContent('description')) ?: $site['tagline'] . '. Auto, Home, Life & Business insurance from ' . $site['agent'] . ', your local Farmers Insurance agent in ' . $site['city'] . ', Michigan. Get a free quote today.';
        $ogImage = asset('images/og-image.jpg');
        $canonical = url()->current();
    @endphp

    <title>{{ $title }}</title>
    <meta name="description" content="{{ $desc }}">
    <link rel="canonical" href="{{ $canonical }}">
    <meta name="robots" content="index, follow">
    <meta name="author" content="{{ $site['agent'] }}">

    {{-- Open Graph --}}
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="{{ $site['agent'] }} — {{ $site['company'] }}">
    <meta property="og:title" content="{{ $title }}">
    <meta property="og:description" content="{{ $desc }}">
    <meta property="og:image" content="{{ $ogImage }}">
    <meta property="og:url" content="{{ $canonical }}">
    <meta property="og:locale" content="en_US">

    {{-- Twitter --}}
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $title }}">
    <meta name="twitter:description" content="{{ $desc }}">
    <meta name="twitter:image" content="{{ $ogImage }}">

    {{-- Favicon --}}
    <link rel="icon" href="{{ asset('images/logo.png') }}" type="image/png">
    <link rel="apple-touch-icon" href="{{ asset('images/logo.png') }}">

    {{-- Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Poppins:wght@500;600;700;800&display=swap" rel="stylesheet">

    {{-- Styles (cache-busted by file modified time so deploys show instantly) --}}
    <link rel="stylesheet" href="{{ asset('css/app.css') }}?v={{ @filemtime(public_path('css/app.css')) ?: '1' }}">

    {{-- Local Business JSON-LD --}}
    <script type="application/ld+json">
    {!! json_encode([
        '@context' => 'https://schema.org',
        '@type' => 'InsuranceAgency',
        'name' => $site['agent'] . ' — ' . $site['company'],
        'image' => $ogImage,
        'url' => url('/'),
        'telephone' => $site['phone'],
        'email' => $site['email'],
        'priceRange' => '$$',
        'address' => [
            '@type' => 'PostalAddress',
            'streetAddress' => $site['address'],
            'addressLocality' => $site['city'],
            'addressRegion' => $site['state'],
            'postalCode' => $site['zip'],
            'addressCountry' => 'US',
        ],
        'areaServed' => $site['state'],
        'description' => $desc,
        'aggregateRating' => [
            '@type' => 'AggregateRating',
            'ratingValue' => $site['reviews_rating'],
            'reviewCount' => (string) $site['reviews_count'],
        ],
    ], JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) !!}
    </script>
    @stack('schema')
</head>
<body>
    <a href="#main" class="skip-link">Skip to content</a>

    @include('partials.topbar')
    @include('partials.header')

    <main id="main">
        @yield('content')
    </main>

    @include('partials.footer')
    @include('partials.conversion')
    @include('partials.quote-popup')

    <script src="{{ asset('js/app.js') }}?v={{ @filemtime(public_path('js/app.js')) ?: '1' }}" defer></script>
    @stack('scripts')
</body>
</html>

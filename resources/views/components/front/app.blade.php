<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>{{ $title ?? null }} :: {{ config('app.name') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="{{ $description ?? null }}">
    <meta name="keyword" content="{{ $keywords ?? null }}">
    <link rel="canonical" href="{{ URL::current() }}" />

    <meta property="og:title" content="{{ $title ?? null }} - {{ config('app.name') }}">
    <meta property="og:description" content="{{ $description ?? null }}">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:image" content="{{ $ogImage ?? 'logo-open-graph.png' }}">
    <meta property="og:type" content="website">
    <meta property="og:locale" content="{{ config('app.locale') }}">

    @if($noindex ?? false)
    <meta name="robots" content="noindex">
    @endif

    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
</head>

<body>

    <header id="MainHeader">
        <div class="container">
            Main header
        </div>
    </header>

    <main class="" id="MainContent">
        <div class="container">
            {{ $slot }}
        </div>
    </main>

    <footer id="MainFooter">
        <div class="container">
            Main footer
        </div>
    </footer>

    <script src="{{ mix('js/app.js') }}" type="text/javascript"></script>
</body>

</html>
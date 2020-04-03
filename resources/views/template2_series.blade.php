<!DOCTYPE html>
<html>
<meta name="csrf-token" content="{{ csrf_token() }}">
<link href="{{ asset('css/all.css') }}" rel="stylesheet">
<script type="text/javascript" src="{{ asset('js/all.js') }}"></script>
<head>
    <title>{{ $data['title'] }}</title>
</head>
<body>
    @include('header')
    @include('breadcrumbs')
    <section class="headline-band__title headline-band__underline">
        <h1 class = "l-center h1">{{ $data['title'] }}</h1>
        <div class="l-center l-content-container paragraph paragraph--type--text paragraph--view-mode--default">
            <div class="body-text"><p>{{ $data['collection_desc'] }}</p></div>
            <section class="cta-links">
              <a href="{{ $data['collection_uri'] }}" target="_blank" class="chevron-link">Read More</a>
            </section>
        </div>
        <h2 class = "headline-band__title l-center h2">
            {{ $data['series_title'] }}
        </h2>
    </section>
    
    @each('seriesentry', $data['entries'], 'data')  

    @include('footer')
</body>
</html>
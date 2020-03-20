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
        {{-- TODO collection descriptions --}}
        <h2 class = "headline-band__title l-center h2">{{ $data['series_title'] }}</h1>
    </section>
    
    @each('seriesentry', $data['entries'], 'data')  

    @include('footer')
</body>
</html>
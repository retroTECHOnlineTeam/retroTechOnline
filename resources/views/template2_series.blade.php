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

    <h2 class = "headline-band__title l-center">{{ $data['title'] }}</h2>
    
    @each('seriesentry', $data['entries'], 'data')  

    @include('footer')
</body>
</html>
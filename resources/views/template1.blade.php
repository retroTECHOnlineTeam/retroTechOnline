<!DOCTYPE html>
<html>
<meta name="csrf-token" content="{{ csrf_token() }}">
<link href="{{ asset('css/all.css') }}" rel="stylesheet">
<script type="text/javascript" src="{{ asset('js/all.js') }}"></script>
<head>
    <title>@yield('title')</title>
</head>
<body>
    @include('header')
    @include('breadcrumbs')

    <h1 class = "headline-band__title l-center">Title @yield('entry_name')</h1>

    <div class="l-center l-content-container headline-band__text">
        <div class="body-text"><p>Overall description text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi sit amet libero ante. Vivamus ut ligula suscipit, eleifend mi ac, elementum eros. Proin hendrerit magna sit amet orci iaculis vehicula. Proin in augue consequat, condimentum augue vitae, iaculis nisl. </p></div>
    </div>


    @include('twoupright')
    @include('twoupleft')

    @include('twoupright')

    @include('twoupleft')

    @include('twoupright')

    @include('twoupleft')

    @include('twoupright')

    @include('twoupleft')

    @include('twoupright')

    @include('twoupleft')

    @include('footer')
</body>
</html>
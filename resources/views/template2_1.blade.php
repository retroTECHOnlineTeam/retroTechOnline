<!DOCTYPE html>
<html>
<meta name="csrf-token" content="{{ csrf_token() }}">
<link href="{{ asset('css/all.css') }}" rel="stylesheet">
<script type="text/javascript" src="{{ asset('js/all.js') }}"></script>
<head>
    <title>{{ $data['entry_title'] }}</title>
</head>
<body>
    @include('header')
    @include('breadcrumbs')

    <h2 class = "headline-band__title l-center">
        <a href="{{ $data['uri_link'] }}">{{ $data['entry_title'] }}</a>
    </h2>
    <h3 class="headline-band__title l-center">{{ $data['agent_name'] }}, {{ $data['entry_date'] }}</h3>

    <div class="l-center l-content-container paragraph paragraph--type--text paragraph--view-mode--default">
        <div class="body-text"><p>{{ $data['entry_description'] }}</p></div>
    </div>

    <div class="l-center l-content-container paragraph paragraph--type--two-up-layout paragraph--view-mode--default">
      <section class="l-two-up-50-50">
        <div class="two-up-layout--content-first">
          @include('emulation')
        </div>
        <div class="two-up-layout--content-second">
          @include('lab')
        </div>
      </section>
    </div>

    @include('footer')
</body>
</html>
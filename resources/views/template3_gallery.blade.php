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
        {{ $data['entry_title'] }}
    </h2>
    <h3 class="headline-band__title l-center">{{ $data['entry_date'] }}</h3>

    <div class="l-center l-content-container paragraph paragraph--type--text paragraph--view-mode--default">
        <div class="body-text"><p>{{ $data['entry_description'] }}</p></div>
        <section class="cta-links">
          <a href="{{ $data['uri_link'] }}" target="_blank" class="chevron-link">Read More</a>
        </section>
    </div>

    <div class="l-center l-content-container paragraph paragraph--type--three-up-layout paragraph--view-mode--default">
      <section class="l-three-up">
        <div class="three-up-layout--content-first">
          @include('oralhistory')
        </div>
        <div class="three-up-layout--content-third">
          @include('lab')
        </div>
        <div class="three-up-layout--content-second">
          @include('oralhistory2')
        </div>
      </section>
    </div>

    @include('gallery')

    @include('footer')
</body>
</html>
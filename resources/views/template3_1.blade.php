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

    <section class = "headline-band__title headline-band__underline l-center h1">
      <h1>{{ $data['entry_title'] }}</h1>
    </section>

    <div class="l-center l-content-container paragraph paragraph--type--text paragraph--view-mode--default">
        <div class="body-text"><p>{{ $data['entry_description'] }}</p></div>
        <section class="cta-links">
          <a href="{{ $data['uri_link'] }}" target="_blank" class="chevron-link">Read More</a>
        </section>
    </div>

    <div class="l-center l-content-container paragraph paragraph--type--three-up-layout paragraph--view-mode--default">
      <section class="l-three-up">
        <div class="three-up-layout--content-first">
          @include('emulation')
        </div>
        <div class="three-up-layout--content-second">
          @include('oralhistory')
        </div>
        <div class="three-up-layout--content-third">
          @include('lab')
        </div>
      </section>
    </div>

    @include('footer')
</body>
</html>
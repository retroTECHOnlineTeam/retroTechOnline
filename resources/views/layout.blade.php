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

	<h2 class = "headline-band__title">Item Name: @yield('entry_name')</h2>
	<h2>Creation Date: @yield('entry_date')</h2>
	<h2>Description: </h2>@yield('entry_description')

	<h2>Oral History with @yield('history_donor')</h2>
	<h2>Date Recorded: @yield('history_date')</h2>
	<h2>Transcript: </h2>@yield('history_transcript')

	@include('template2')

	@include('footer')
</body>
</html>
<!DOCTYPE html>
<html>
<head>
	<title>@yield('title')</title>
</head>
<body>
	<!-- @yield('header') -->

	<h2>Item Name: @yield('entry_name')</h2>
	<h3>Creation Date: @yield('entry_date')</h3>
	<h3>Description: </h3>@yield('entry_description')

	<h2>Oral History with @yield('history_donor')</h2>
	<h3>Date Recorded: @yield('history_date')</h3>
	<h3>Transcript: </h3>@yield('history_transcript')

	<!-- @yield('footer') -->
</body>
</html>
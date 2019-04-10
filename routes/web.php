<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('layout');
});

Route::get('/entry', function () {
    return view('entry');
});

Route::get('/{id}', function ($id) {

	$cli = new ArchiveSpaceApi();
	$data = $cli->serveASpaceData($id);
    return view('entry', ['data' => $data]);
});
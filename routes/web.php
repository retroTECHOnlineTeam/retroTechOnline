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

Route::get('/1', function () {
    return view('template1');
});

Route::get('/2r', function () {
    return view('template2');
});

Route::get('/2l', function () {
    return view('template2left');
});

Route::get('/entry', function () {
    return view('entry');
});

Route::get('/cooking-mama', function () {

    $cli = new ArchiveSpaceApi();
    $data = $cli->serveASpaceDataFromAO(86914);
    return view('template3', ['data' => $data]);
});

Route::get('/{id}', function ($id) {

	$cli = new ArchiveSpaceApi();
	$data = $cli->serveASpaceDataFromAO($id);
    return view('template3', ['data' => $data]);
});
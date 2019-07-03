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

Route::get('/cooking-mama', function () {

    $cli = new ArchiveSpaceApi();
    $data = $cli->serveASpaceDataFromAO(86914);
    $emulation_img = ImageLookup::lookupEmulationImg(86914);
    $history_img = ImageLookup::lookupHistoryImg(86914);
    return view('template3', ['data' => $data, 'emulation' => $emulation_img, 'history' => $history_img]);
});

Route::get('/{id}', function ($id) {

	$cli = new ArchiveSpaceApi();
	$data = $cli->serveASpaceDataFromAO($id);
    $emulation_img = ImageLookup::lookupEmulationImg($id); //if exists
    $history_img = ImageLookup::lookupHistoryImg($id); //if exists
    return view('template2', ['data' => $data, 'emulation' => $emulation_img, 'history' => $history_img]);
});
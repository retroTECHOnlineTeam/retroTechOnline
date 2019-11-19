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

Route::get('/cooking-mama', function () {

    $cli = new ArchiveSpaceApi();
    $data = $cli->serveASpaceDataFromAO(86914);
    $cli->authenticate();
    $history_obj = $cli->getDigitalObject(ArchiveSpaceApi::_getIDFromUrl($data['instances'][1]['digital_object']['ref']));
    $emulation_obj =$cli->getDigitalObject(ArchiveSpaceApi::_getIDFromUrl($data['instances'][0]['digital_object']['ref']));
    $agent = $cli->getAgentById(ArchiveSpaceApi::_getIDFromUrl($data['linked_agents'][0]['ref']));
    $data2 = Data::extractEntryData($data);
    $data3 = Data::extractOralHistoryData($history_obj);
    $data4 = Data::extractEmulationData($emulation_obj);
    $all_data = array_merge($data2, $data3, $data4, array("agent_name" => $agent["title"]));
    // var_dump($all_data);
    $emulation_img = ImageLookup::lookupEmulationImg(86914);
    $history_img = ImageLookup::lookupHistoryImg(86914);
    return view('template3_1', ['data' => $all_data, 'emulation' => $emulation_img, 'history' => $history_img]);
});

Route::get('/yeji', function () {

    $cli = new ArchiveSpaceApi();
    $data = $cli->serveASpaceDataFromAO(86910);
    //$emulation_img = ImageLookup::lookupEmulationImg(86914);
    //$history_img = ImageLookup::lookupHistoryImg(86914);
    //return view('template3', ['data' => $data, 'emulation' => $emulation_img, 'history' => $history_img]);
    return view('template2_1', ['data' => $data,]);
});

Route::get('/ribbit', function () {

    $cli = new ArchiveSpaceApi();
    $data = $cli->serveASpaceDataFromResource(1753);
    //$emulation_img = ImageLookup::lookupEmulationImg(86914);
    //$history_img = ImageLookup::lookupHistoryImg(86914);
    //return view('template3', ['data' => $data, 'emulation' => $emulation_img, 'history' => $history_img]);
    var_dump($data);
    //return view('template3_1', ['data' => $data,]);
});

Route::get('/toak', function () {

    $cli = new ArchiveSpaceApi();
    $data = $cli->serveASpaceDataFromResource(1765);
    $data['history_url'] = $cli->serveASpaceDataFromDO(5089)['emulation_url'];
    $oh2 = $cli->serveASpaceDataFromDO(5090);
    $emulation_img = ImageLookup::lookupEmulationImg(1765);
    $history_img = ImageLookup::lookupHistoryImg(86914);
    var_dump($data);
    // two oral histories
    return view('template3_2', ['data' => $data, 'emulation' => $emulation_img, 'history' => $history_img]);
});

Route::get('/olympics', function () {

    //TBD - is an accession currently

    $cli = new ArchiveSpaceApi();
    //$data = $cli->serveASpaceDataFromResource(1765);
    //$emulation_img = ImageLookup::lookupEmulationImg(86914);
    //$history_img = ImageLookup::lookupHistoryImg(86914);
    //return view('template3', ['data' => $data, 'emulation' => $emulation_img, 'history' => $history_img]);
    var_dump($data);
    //return view('template23', ['data' => $data,]);
});

Route::get('/pyburn', function () {

    // TBD

    $cli = new ArchiveSpaceApi();
    $data = $cli->serveASpaceDataFromResource(1765);
    //$emulation_img = ImageLookup::lookupEmulationImg(86914);
    //$history_img = ImageLookup::lookupHistoryImg(86914);
    //return view('template3', ['data' => $data, 'emulation' => $emulation_img, 'history' => $history_img]);
    var_dump($data);
    //return view('template23', ['data' => $data,]);
});

Route::get('/{id}', function ($id) {

	$cli = new ArchiveSpaceApi();
	$data = $cli->serveASpaceDataFromResource($id);
    var_dump($data);
});



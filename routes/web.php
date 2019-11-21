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
    $cli->authenticate(); // must authenticate here again to make more calls to Aspace server
    $history_obj = $cli->getDigitalObject(ArchiveSpaceApi::_getIDFromUrl($data['instances'][1]['digital_object']['ref']));
    $emulation_obj =$cli->getDigitalObject(ArchiveSpaceApi::_getIDFromUrl($data['instances'][0]['digital_object']['ref']));
    $agent = $cli->getAgentById(ArchiveSpaceApi::_getIDFromUrl($data['linked_agents'][0]['ref']));
    // TODO clean this up
    $data2 = Data::extractArchivalObjectData($data);
    $data3 = Data::extractOralHistoryData($history_obj);
    $data4 = Data::extractEmulationData($emulation_obj);
    $all_data = array_merge($data2, $data3, $data4, array("agent_name" => $agent["title"]));
    $emulation_img = ImageLookup::lookupEmulationImg(86914);
    $history_img = ImageLookup::lookupHistoryImg(86914);
    return view('template3_1', ['data' => $all_data, 'emulation' => $emulation_img, 'history' => $history_img]);
});

Route::get('/yeji', function () {

    $cli = new ArchiveSpaceApi();
    $data = $cli->serveASpaceDataFromAO(86910);
    //return view('template3', ['data' => $data, 'emulation' => $emulation_img, 'history' => $history_img]);
    return view('template2_1', ['data' => $data,]);
});

Route::get('/ribbit', function () {

    $cli = new ArchiveSpaceApi();
    $data = $cli->serveASpaceDataFromResource(1753);
    $mapped_data = Data::extractResourceData($data);
    $cli->authenticate();
    $history_obj = $cli->getDigitalObject(5084);
    // TODO waiting on url in aspace
    //$history_data = Data::extractOralHistoryData($history);
    $emulation_obj = $cli->getDigitalObject(5080);
    // TODO waiting on url in aspace
    //$emulation_data = Data::extractEmulationData($emulation_obj);
    //return view('template3', ['data' => $data, 'emulation' => $emulation_img, 'history' => $history_img]);
    var_dump($mapped_data);
    var_dump($emulation_obj);
    //return view('template3_1', ['data' => $data,]);
});

Route::get('/toak', function () {

    $cli = new ArchiveSpaceApi();
    $data = $cli->serveASpaceDataFromResource(1765);
    //$data['history_url'] = $cli->serveASpaceDataFromDO(5089)['emulation_url'];
    //$oh2 = $cli->serveASpaceDataFromDO(5090);
    $cli->authenticate();
    $history_obj1 = $cli->getDigitalObject(5089);
    $history_data1 = Data::extractOralHistoryData($history_obj1);
    $history_obj2 = $cli->getDigitalObject(5090);
    $history_data2 = Data::extractOralHistoryData($history_obj2);
    // TODO pull images from smarttech
    $emulation_img = ImageLookup::lookupEmulationImg(1765);
    $history_img = ImageLookup::lookupHistoryImg(86914);
    var_dump($data, $history_data1, $history_data2);
    // two oral histories
    //return view('template3_2', ['data' => $data, 'emulation' => $emulation_img, 'history' => $history_img]);
});

Route::get('/olympics', function () {

    //TBD - is an accession currently

    $cli = new ArchiveSpaceApi();
    var_dump($data);
    //return view('template23', ['data' => $data,]);
});

Route::get('/pyburn', function () {

    // TBD

    $cli = new ArchiveSpaceApi();
    //$data = $cli->serveASpaceDataFromResource(1765);
    var_dump($data);
    //return view('template23', ['data' => $data,]);
});

Route::get('/{id}', function ($id) {

    // TBD - show error for any other url

	$cli = new ArchiveSpaceApi();
	$data = $cli->serveASpaceDataFromResource($id);
    var_dump($data);
});



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
    $series_data = $cli->serveASpaceDataFromAO(86913);

    $cli->authenticate(); // must authenticate here again to make more calls to Aspace server
    $history_obj = $cli->getDigitalObject(ArchiveSpaceApi::_getIDFromUrl($data['instances'][1]['digital_object']['ref']));
    $emulation_obj =$cli->getDigitalObject(ArchiveSpaceApi::_getIDFromUrl($data['instances'][0]['digital_object']['ref']));
    $agent = $cli->getAgentById(ArchiveSpaceApi::_getIDFromUrl($data['linked_agents'][0]['ref']));

    $mapped_data = Data::extractArchivalObjectData($data);
    $history_data = Data::extractOralHistoryData($history_obj);
    $emulation_data = Data::extractEmulationData($emulation_obj);
    $mapped_series_data = Data::extractArchivalObjectData($series_data); // need for date
    $agent_formatted = Data::formatName($agent["title"]);

    $all_data = array_merge($mapped_data, $emulation_data, array("agent_name" => $agent_formatted, "entry_date" => $mapped_series_data["entry_date"]));
    $emulation_img = ImageLookup::lookupEmulationImg(86914);
    $history_img = ImageLookup::lookupHistoryImg(86914);
    return view('template3_1', 
                ['data' => $all_data, 
                'emulation' => $emulation_img, 
                'history' => $history_img, 
                'history_data' => $history_data]);
});

Route::get('/yeji', function () {
    $cli = new ArchiveSpaceApi();
    $data = $cli->serveASpaceDataFromAO(86910);
    // get date from upper container
    $series_data = $cli->serveASpaceDataFromAO(86909);
    
    $cli->authenticate(); // must authenticate here again to make more calls to Aspace server
    $history_obj = $cli->getDigitalObject(ArchiveSpaceApi::_getIDFromUrl($data['instances'][1]['digital_object']['ref']));
    $emulation_obj =$cli->getDigitalObject(ArchiveSpaceApi::_getIDFromUrl($data['instances'][0]['digital_object']['ref']));
    $agent = $cli->getAgentById(ArchiveSpaceApi::_getIDFromUrl($data['linked_agents'][0]['ref']));

    $mapped_data = Data::extractArchivalObjectData($data);
    $history_data = Data::extractOralHistoryData($history_obj);
    $emulation_data = Data::extractEmulationData($emulation_obj);
    $mapped_series_data = Data::extractArchivalObjectData($series_data); // need for date
    $agent_formatted = Data::formatName($agent["title"]);

    $all_data = array_merge($mapped_data, $history_data, $emulation_data, array("agent_name" => $agent_formatted, "entry_date" => $mapped_series_data["entry_date"]));
    $emulation_img = ImageLookup::lookupEmulationImg(86914);
    $history_img = ImageLookup::lookupHistoryImg(86914);
    //var_dump($all_data);
    return view('template3_1', ['data' => $all_data, 'emulation' => $emulation_img, 'history' => $history_img, 'history_data' => $history_data]);
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
    $mapped_data = Data::extractResourceData($data);
    $cli->authenticate();
    $history_obj1 = $cli->getDigitalObject(5089);
    $history_data1 = Data::extractOralHistoryData($history_obj1);
    $history_obj2 = $cli->getDigitalObject(5090);
    $history_data2 = Data::extractOralHistoryData($history_obj2);
    // TODO pull images from smarttech, cleanup
    $emulation_img = ImageLookup::lookupEmulationImg(1765);
    $history_img = ImageLookup::lookupHistoryImg(86914);
    //var_dump($mapped_data, $history_data1, $history_data2);
    return view('template3_2', ['data' => $mapped_data, 'emulation' => $emulation_img, 'history' => $history_img, 'history_data' => $history_data1, 'history_data2' => $history_data2]);
});

Route::get('/olympics', function () {

    //TBD - is an accession currently
    $cli = new ArchiveSpaceApi();
    //var_dump($data);
    return view('gallery');
});

Route::get('/{id}', function ($id) {

    // TBD - show error for any other url

	$cli = new ArchiveSpaceApi();
	$data = $cli->serveASpaceDataFromResource($id);
    var_dump($data);
});



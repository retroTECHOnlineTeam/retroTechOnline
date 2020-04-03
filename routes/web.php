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

Route::get('/cs2261', function () {
    $cli = new ArchiveSpaceApi();
    $resource_data = $cli->serveASpaceDataFromResource(1762, true);
    $collection_data = Data::extractCollectionData($resource_data);
    $entries = array();

    foreach ($resource_data["children"] as $series) {
        $series_title = Data::extractTitle($series);
        $series_uri = Data::extractUri($series);
        $count = 0;
        foreach ($series["children"] as $entry) {
            // check if the entry has two digital objects (oral history & emulation link)
            if (sizeof($entry["instance_types"]) > 1) {
                $entry_data = array();
                $entry_data = $cli->getCs2261Entry($entry["id"]);
                $entries[$count] = $entry_data;
                $count++;
            }
        }
    }

    $data = array_merge($collection_data, array("series_title" => $series_title, "uri_link" => $series_uri), ["entries" => $entries]);
    return view('template2_series', ["data" => $data]);
});

// TODO use combined oral history/emulation video and 2up
Route::get('/cooking-mama', function () {

    $cli = new ArchiveSpaceApi();
    $data = $cli->serveASpaceDataFromAO(86914);
    $series_data = $cli->serveASpaceDataFromAO(86913); // get date from upper container
    var_dump($series_data);

    $cli->authenticate(); // must authenticate here again to make more calls to Aspace server
    $history_obj = $cli->getDigitalObject(ArchiveSpaceApi::_getIDFromUrl($data['instances'][1]['digital_object']['ref']));
    $emulation_obj =$cli->getDigitalObject(ArchiveSpaceApi::_getIDFromUrl($data['instances'][0]['digital_object']['ref']));
    $agent = $cli->getAgentById(ArchiveSpaceApi::_getIDFromUrl($data['linked_agents'][0]['ref']));

    $mapped_data = Data::extractArchivalObjectData($data);
    $history_data = Data::extractOralHistoryData($history_obj);
    $emulation_data = Data::extractEmulationData($emulation_obj);
    $mapped_series_data = Data::extractArchivalObjectData($series_data); // need for date
    $agent_formatted = Data::formatName($agent["title"]);

    // TODO pull this link from aspace DO file versions[1]
    $emulation_img = "https://smartech.gatech.edu/bitstream/handle/1853/61883/Cooking-Mama-Food-Fight-screenshot.jpg";
    $history_img = "https://smartech.gatech.edu/bitstream/handle/1853/61883/Cooking-Mama-Food-Fight-screenshot.jpg";
    $all_data = array_merge($mapped_data, array("history_img" => $history_img, "emulation_img" => $emulation_img, "agent_name" => $agent_formatted, "entry_date" => $mapped_series_data["entry_date"]));
    //print_r($all_data);
    return view('template3_1', 
                ['data' => $all_data, 
                'history_data' => $history_data,
                'emulation_data' => $emulation_data]);
});

// TODO feature in series of CS2110 projects
Route::get('/yeji', function () {
    $cli = new ArchiveSpaceApi();
    $data = $cli->serveASpaceDataFromAO(86910);
    $series_data = $cli->serveASpaceDataFromAO(86909); // get date from upper container
    
    $cli->authenticate(); // must authenticate here again to make more calls to Aspace server
    $history_obj = $cli->getDigitalObject(ArchiveSpaceApi::_getIDFromUrl($data['instances'][1]['digital_object']['ref']));
    $emulation_obj =$cli->getDigitalObject(ArchiveSpaceApi::_getIDFromUrl($data['instances'][0]['digital_object']['ref']));
    $agent = $cli->getAgentById(ArchiveSpaceApi::_getIDFromUrl($data['linked_agents'][0]['ref']));

    $mapped_data = Data::extractArchivalObjectData($data);
    $history_data = Data::extractOralHistoryData($history_obj);
    $emulation_data = Data::extractEmulationData($emulation_obj);
    $mapped_series_data = Data::extractArchivalObjectData($series_data); // need for date
    $agent_formatted = Data::formatName($agent["title"]);

    
    // TODO pull this link from aspace DO file versions[1]
    $emulation_img = "https://smartech.gatech.edu/bitstream/handle/1853/61891/Yeji-screenshot.jpg";
    $history_img = "https://smartech.gatech.edu/bitstream/handle/1853/61891/Yeji-screenshot.jpg";
    $all_data = array_merge($mapped_data, $history_data, $emulation_data, array("history_img" => $history_img, "emulation_img" => $emulation_img, "agent_name" => $agent_formatted, "entry_date" => $mapped_series_data["entry_date"]));
    return view('template3_1', 
                ['data' => $all_data, 
                'history_data' => $history_data]);
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
    // TODO waiting on emulation landing page url in aspace
    //$emulation_data = Data::extractEmulationData($emulation_obj);
    //return view('template3', ['data' => $data, 'emulation' => $emulation_img, 'history' => $history_img]);
    //var_dump($mapped_data);
    //var_dump($emulation_obj);
    //return view('template3_1', ['data' => $data,]);
});

Route::get('/knowbot', function () {

    $cli = new ArchiveSpaceApi();
    $data = $cli->serveASpaceDataFromResource(1765);
    $mapped_data = Data::extractResourceData($data);
    
    $cli->authenticate();
    $history_obj1 = $cli->getDigitalObject(5089);
    $history_data1 = Data::extractOralHistoryData($history_obj1);
    $history_obj2 = $cli->getDigitalObject(5090);
    $history_data2 = Data::extractOralHistoryData($history_obj2);
    
    // TODO pull this link from aspace DO file versions[1]
    // stored on alan porter's oral history object
    $emulation_img = "https://smartech.gatech.edu/bitstream/handle/1853/61897/VantagePoint-screenshot.jpg";
    $history_img = "https://smartech.gatech.edu/bitstream/handle/1853/61897/Alan-Porter-oral-history-screenshot.jpg";
    $history_img2 = "https://smartech.gatech.edu/bitstream/handle/1853/61898/Nils-Newman-oral-history-screenshot.jpg";
    $all_data = array_merge($mapped_data, array("emulation_img" => $emulation_img, "history_img" => $history_img, "history_img2" => $history_img2));
    return view('template3_2', 
                ['data' => $all_data, 
                'history_data' => $history_data1, 
                'history_data2' => $history_data2]);
});

Route::get('/olympics', function () {

    $cli = new ArchiveSpaceApi();
    $data = $cli->serveASpaceDataFromResource(1770);
    $mapped_data = Data::extractResourceData2($data);

    $gallery_data = $cli->serveDigitalObjectCollectionFromAO(89136);
    $mapped_gallery_data = Data::extractGalleryData($gallery_data);

    $cli->authenticate();
    $history_obj1 = $cli->getDigitalObject(5103);
    $history_data1 = Data::extractOralHistoryData($history_obj1);
    $history_obj2 = $cli->getDigitalObject(5103);
    $history_data2 = Data::extractOralHistoryData($history_obj2);

    // TODO pull this link from aspace DO file versions[1]
    $history_img = "https://smartech.gatech.edu/bitstream/handle/1853/62114/Scott-Robertson-oral-history-screenshot.jpeg?sequence=5&isAllowed=y";
    $history_img2 = "https://smartech.gatech.edu/bitstream/handle/1853/62114/Scott-Robertson-oral-history-screenshot.jpeg?sequence=5&isAllowed=y";
    
    $all_data = array_merge($mapped_data, $mapped_gallery_data, array("history_img" => $history_img, "history_img2" => $history_img2));
    return view('template3_gallery',
                ['data' => $all_data, 
                'history_data' => $history_data1, 
                'history_data2' => $history_data2]);
});

// Used for dev testing, shouldn't be any real api calls
Route::get('/testing', function () {
    return view('template1');
});

?>
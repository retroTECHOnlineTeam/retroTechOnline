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


// TODO feature in series of CS2261 projects
Route::get('/cooking-mama', function () {

    $cli = new ArchiveSpaceApi();
    $data = $cli->serveASpaceDataFromAO(86914);
    $series_data = $cli->serveASpaceDataFromAO(86913); // get date from upper container

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
    $all_data = array_merge($mapped_data, $emulation_data, array("history_img" => $history_img, "emulation_img" => $emulation_img, "agent_name" => $agent_formatted, "entry_date" => $mapped_series_data["entry_date"]));
    return view('template3_1', 
                ['data' => $all_data, 
                'history_data' => $history_data]);
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

    //TODO - is an accession currently, 1770
    $cli = new ArchiveSpaceApi();
    //var_dump($data);
    return view('gallery');
});

?>
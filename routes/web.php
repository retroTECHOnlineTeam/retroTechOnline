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
// TODO use combined oral history/emulation video and 2up
    foreach ($resource_data["children"] as $series) {
        $series_title = Data::extractTitle($series);
        $series_uri = Data::extractUri($series);
        $count = 0;
        foreach ($series["children"] as $entry) {
            // check if the entry has a digital object (emulation link at least)
            if (sizeof($entry["instance_types"]) > 0) {
                $entry_data = array();
                $entry_data = $cli->getTwoUpEntry($entry["id"]);
                $entries[$count] = $entry_data;
                $count++;
            }
        }
    }

    $data = array_merge($collection_data, array("series_title" => $series_title, "uri_link" => $series_uri), ["entries" => $entries]);
    return view('template2_series', ["data" => $data]);
});

Route::get('/cs2110', function () {
    $cli = new ArchiveSpaceApi();
    $resource_data = $cli->serveASpaceDataFromResource(1761, true);
    $collection_data = Data::extractCollectionData($resource_data);
    $entries = array();
// TODO use combined oral history/emulation video and 2up
    foreach ($resource_data["children"] as $series) {
        $series_title = Data::extractTitle($series);
        $series_uri = Data::extractUri($series);
        $count = 0;
        foreach ($series["children"] as $entry) {
            // check if the entry has a digital object (emulation link at least)
            if (sizeof($entry["instance_types"]) > 0) {
                $entry_data = array();
                $entry_data = $cli->getTwoUpEntry($entry["id"]);
                $entries[$count] = $entry_data;
                $count++;
            }
        }
    }

    $data = array_merge($collection_data, array("series_title" => $series_title, "uri_link" => $series_uri), ["entries" => $entries]);
    return view('template2_series', ["data" => $data]);
});

Route::get('/ribbit', function () {

    $cli = new ArchiveSpaceApi();
    $tree = $cli->serveASpaceDataFromResource(1753, true);
    $data = $cli->serveASpaceDataFromResource(1753, false);
    $mapped_data = Data::extractResourceData2($data);
    
    $cli->authenticate();
    $agent = $cli->getAgentById(ArchiveSpaceApi::_getIDFromUrl($data['linked_agents'][0]['ref']));
    $agent_formatted = Data::formatName($agent["title"]);

    $history_ao = $cli->getArchivalObject($tree['children'][1]['id']);
    $history_obj = $cli->getDigitalObjectsFromArchivalObject($history_ao)[0];
    $history_data = Data::extractOralHistoryData($history_obj);
    // different one
    $history_img = $history_obj['file_versions'][1]['file_uri'];

    $emulation_ao = $cli->getArchivalObject($tree['children'][0]['id']);
    $emulation_obj = $cli->getDigitalObjectsFromArchivalObject($emulation_ao)[0];
    $emulation_data = Data::extractEmulationData($emulation_obj);
    $emulation_img = $emulation_obj['file_versions'][1]['file_uri'];
    $all_data = array_merge($mapped_data, array("emulation_img" => $emulation_img, "history_img" => $history_img, "agent_name" => $agent_formatted));
    return view('template3_1', 
                ['data' => $all_data, 
                'history_data' => $history_data,
                'emulation_data' => $emulation_data]);
});

Route::get('/pyburn', function () {

    $cli = new ArchiveSpaceApi();
    $data = $cli->serveASpaceDataFromDO(89591);
    $mapped_data = Data::extractDigitalObjectData($data);


    
    $cli->authenticate();
    $agent = $cli->getAgentById(ArchiveSpaceApi::_getIDFromUrl($data['linked_agents'][0]['ref']));
    $agent_formatted = Data::formatName($agent["title"]);

    $history_ao = $cli->getArchivalObject($tree['children'][1]['id']);
    $history_obj = $cli->getDigitalObjectsFromArchivalObject($history_ao)[0];
    $history_data = Data::extractOralHistoryData($history_obj);
    $history_img = $history_obj['file_versions'][1]['file_uri'];

    $emulation_ao = $cli->getArchivalObject($tree['children'][0]['id']);
    $emulation_obj = $cli->getDigitalObjectsFromArchivalObject($emulation_ao)[0];
    $emulation_data = Data::extractEmulationData($emulation_obj);
    $emulation_img = $emulation_obj['file_versions'][1]['file_uri'];
    $all_data = array_merge($mapped_data, array("emulation_img" => $emulation_img, "history_img" => $history_img, "agent_name" => $agent_formatted));
    return view('template3_1', 
                ['data' => $all_data, 
                'history_data' => $history_data,
                'emulation_data' => $emulation_data]);
});

Route::get('/knowbot', function () {

    $cli = new ArchiveSpaceApi();
    $data = $cli->serveASpaceDataFromResource(1765);
    $mapped_data = Data::extractResourceData($data);
    
    $cli->authenticate();
    $history1_obj = $cli->getDigitalObject(5089);
    $history1_data = Data::extractOralHistoryData($history1_obj);
    $history_img = $history1_obj['file_versions'][1]['file_uri'];
    
    $history2_obj = $cli->getDigitalObject(5090);
    $history2_data = Data::extractOralHistoryData($history2_obj);
    $history2_img = $history2_obj['file_versions'][1]['file_uri'];

    $emulation_img = $history1_obj['file_versions'][2]['file_uri'];

    $all_data = array_merge($mapped_data, array("emulation_img" => $emulation_img, "history_img" => $history_img, "history2_img" => $history2_img));
    return view('template3_2', 
                ['data' => $all_data, 
                'history_data' => $history1_data, 
                'history2_data' => $history2_data]);
});

Route::get('/olympics', function () {

    $cli = new ArchiveSpaceApi();
    $resource_data = $cli->serveASpaceDataFromResource(1770, false);
    $mapped_data = Data::extractResourceData2($resource_data);

    $gallery_data = $cli->serveDigitalObjectCollectionFromAO(89136);
    $mapped_gallery_data = Data::extractGalleryData($gallery_data);

    // get history Digital Objects ids from resource tree, then fetch by id
    $tree = $cli->serveASpaceDataFromResource(1770, true);
    $doc_id = $tree['children'][2]['id'];

    $cli->authenticate();
    $doc_ao = $cli->getArchivalObject($doc_id);
    $doc_do = $cli->getDigitalObjectsFromArchivalObject($doc_ao)[0];
    $documentation_data = Data::extractDocumentationData($doc_do);
    $documentation_data['description'] = $doc_ao['notes'][0]['subnotes'][0]['content'];
    $documentation_data['date'] = $doc_ao['dates'][0]['expression'];

    $history1_obj = $cli->getArchivalObject($tree['children'][0]['children'][0]['id']);
    $history1_data = Data::extractOralHistoryData($history1_obj);
    $history1_do = $cli->getDigitalObjectsFromArchivalObject($history1_obj);
    // note this variable needs to be 'history_img' not 'history1_img' to display both properly
    $history_img = $history1_do[0]['file_versions'][1]['file_uri'];

    
    $history2_obj = $cli->getArchivalObject($tree['children'][0]['children'][1]['id']);
    $history2_do = $cli->getDigitalObjectsFromArchivalObject($history2_obj);
    $history2_data = Data::extractOralHistoryData($history2_do[0]);
    $history2_img = $history2_do[0]['file_versions'][1]['file_uri'];
    
    $all_data = array_merge($mapped_data, $mapped_gallery_data, array("history_img" => $history_img, "history2_img" => $history2_img));
    return view('template3_gallery',
                ['data' => $all_data, 
                'history_data' => $history1_data, 
                'history2_data' => $history2_data,
                'documentation_data' => $documentation_data]);
});

// Used for dev testing, shouldn't be any real api calls
Route::get('/testing', function () {
    return view('template1');
});

?>
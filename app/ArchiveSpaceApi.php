<?php

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;

class ArchiveSpaceApi {
  var $client;
  var $session_id;

  # create Guzzle client for HTTP requests
  public function __construct() {
    $this->client = new Client([
      // Base URI is used with relative requests
      'base_uri' => BASE_URI,
      'connect_timeout' => 2.0,
      'on_stats' => function (GuzzleHttp\TransferStats $stats) use (&$url) {
        $url = $stats->getEffectiveUri(); }
    ]);
    echo "Guzzle client created.\n";
  }

  public function authenticate() {
    try {
      // sanitize this?
      $authuri = BASE_URI . '/users/' . USERNAME . '/login?password=' . PASSWORD;

      $response = $this->client->request('POST', $authuri, [
        'on_stats' => function (GuzzleHttp\TransferStats $stats) use (&$url) {
          $url = $stats->getEffectiveUri();
        }]);

      echo "Sending request to " . $url . "\n";
    } catch (GuzzleHttp\Exception\ServerException $e) {
      echo "The server is unavailable.\n";
    } catch (GuzzleHttp\Exception\ClientException $e) {
      echo "There was a problem with your request.\n";
      echo 'HTTP request URL: ' . $url . "\n";
      echo 'HTTP response status: ' . $e->getResponse()->getStatusCode() . "\n";
      echo 'Exception: ' . $e->getMessage() . "\n";
      die(); // use retry with recurs limit
    }
    if ($response->getStatusCode() == 200) {
      echo "Successfully authenticated!\n";
      $data = json_decode($response->getBody(), true);
      $this->session_id = $data['session']; // make a test for this      
      echo "Session id " . $this->session_id . " saved.\n";
    } else {
      throw new Error("Something went wrong with your request. Unable to authenticate.\n");
    }
  }

  public function getResource(int $record_id, bool $get_tree) {
    if ($get_tree) {
      $url = BASE_URI . '/repositories/' . REPO_ID . '/resources/' . $record_id . '/tree';
    } else {
      $url = BASE_URI . '/repositories/' . REPO_ID . '/resources/' . $record_id;
    }


    try {
      $response = $this->client->request('GET', $url, [
        'headers' => ['X-ArchivesSpace-Session' => $this->session_id],
        'on_stats' => function (GuzzleHttp\TransferStats $stats) use (&$url) {
          $url = $stats->getEffectiveUri();
        }]);
    } catch (GuzzleHttp\Exception\ClientException $e) {
      echo "There was a problem with your request.\n";
      echo 'HTTP request URL: ' . $url . "\n";
      echo 'HTTP response status: ' . $e->getResponse()->getStatusCode() . "\n";
      echo 'Exception: ' . $e->getMessage() . "\n";
      die(); // make this a retry with a recurs limit
    }

    if ($response->getStatusCode() == 200) {
      echo "Successfully retrieved resource!\n";
      $data = json_decode($response->getBody(), true);
      //var_dump($data); 
      return($data);
    } else {
      throw new Error("Something went wrong with your request. Unable to get resource.\n");
    }
  }

  public function getDigitalObject(int $digitalobject_id) {
    $url = BASE_URI . '/repositories/' . REPO_ID . '/digital_objects/' . $digitalobject_id;

    try {
      $response = $this->client->request('GET', $url, [
        'headers' => ['X-ArchivesSpace-Session' => $this->session_id],
        'on_stats' => function (GuzzleHttp\TransferStats $stats) use (&$url) {
          $url = $stats->getEffectiveUri();
        }]);
    } catch (GuzzleHttp\Exception\ClientException $e) {
      echo "There was a problem with your request.\n";
      echo 'HTTP request URL: ' . $url . "\n";
      echo 'HTTP response status: ' . $e->getResponse()->getStatusCode() . "\n";
      echo 'Exception: ' . $e->getMessage() . "\n";
      die(); // make this a retry with a recurs limit
    }

    if ($response->getStatusCode() == 200) {
      echo "Successfully retrieved digital object!\n";
      $data = json_decode($response->getBody(), true);
      //var_dump($data);
      return($data);
    } else {
      throw new Error("Something went wrong with your request. Unable to get digital object.\n");
    }
  }

  public function getArchivalObject(int $archivalobject_id) {
    $url = BASE_URI . '/repositories/' . REPO_ID . '/archival_objects/' . $archivalobject_id;

    try {
      $response = $this->client->request('GET', $url, [
        'headers' => ['X-ArchivesSpace-Session' => $this->session_id],
        'on_stats' => function (GuzzleHttp\TransferStats $stats) use (&$url) {
          $url = $stats->getEffectiveUri();
        }]);
    } catch (GuzzleHttp\Exception\ClientException $e) {
      echo "There was a problem with your request.\n";
      echo 'HTTP request URL: ' . $url . "\n";
      echo 'HTTP response status: ' . $e->getResponse()->getStatusCode() . "\n";
      echo 'Exception: ' . $e->getMessage() . "\n";
      die(); // make this a retry with a recurs limit
    }

    if ($response->getStatusCode() == 200) {
      echo "Successfully retrieved archival object!\n";
      $data = json_decode($response->getBody(), true);
      //var_dump($data);
      return($data);
    } else {
      throw new Error("Something went wrong with your request. Unable to get archival object.\n");
    }
  }

  public function getObjectsFromTree(array $resource_tree) {
    $ret = array();
    foreach ($resource_tree["children"] as $child) {
      array_push($ret, $this->getArchivalObject($child["id"]));
      // add to return array
    }
    return ($ret);
  }

  public function getDigitalObjectsFromArchivalObject(array $archivalobject) {
    $ret = array();
    foreach ($archivalobject["instances"] as $instance) {
      $do_ref = end(explode("/", $instance["digital_object"]["ref"]));
      // add check here that ref is a valid integer/not empty
      array_push($ret, $this->getDigitalObject($do_ref));
    }
    return ($ret);
  }

  public function getArchivalObjectFromDigitalObject(array $digitalobject) {
    $ao_ref = explode("/", $digitalobject["linked_instances"][0]["ref"]);
    return $this->getArchivalObject(end($ao_ref));
  }

  public function outputDigitalObjects(array $object_array) {
    $i = 0;
    foreach ($object_array as $obj) {
      echo("Object ".$i.":\n");
      echo($obj['title']."\n");
      echo($obj['digital_object_id']."\n");
      //var_dump($obj);
      $i++;
    }
  }

  public function serveASpaceData(int $do_id) {
    $cli = new ArchiveSpaceApi();
    $cli->authenticate();
    // Fetch digital object from id given as route url parameter
    $do = $cli->getDigitalObject($do_id);
    $ao = $cli->getArchivalObjectFromDigitalObject($do);
    $data = array("entry_name"        => $ao['display_string'],
                  "entry_date"        => $ao['dates'][0]['expression'],
                  "entry_description" => $do['notes'],
                  "emulation_url"     => $do['digital_object_id']);
    var_dump($data);
    return $data;
  }
}

?>
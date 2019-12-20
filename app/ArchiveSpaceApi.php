<?php

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;

/**
* ArchiveSpaceApi is a class for getting data from the ArchiveSpace server

* Authentication note: See Readme about setting up the api credentials
*
* @author Maura Gerke 
*/
class ArchiveSpaceApi {
  var $client;
  var $session_id;

  /**
  * Utility function to extract ArchiveSpace ID from a url
  */
  static function _getIDFromUrl(string $url) {
    $exploded_url = explode('/', $url);
    $len = sizeof($exploded_url);
    return $exploded_url[$len - 1];
  }

  /**
  * Create a Guzzle client for HTTP requests
  */
  public function __construct() {
    $this->client = new Client([
      // Base URI is used with relative requests
      'base_uri' => BASE_URI,
      'verify' => false, // check this
      'connect_timeout' => 2.0,
      'on_stats' => function (GuzzleHttp\TransferStats $stats) use (&$url) {
        $url = $stats->getEffectiveUri(); }
    ]);
    //echo "Guzzle client created.\n";
  }

  /**
  * Authenticate and create session with the ArchiveSpace server
  */
  public function authenticate() {
    try {
      // sanitize this?
      $authuri = BASE_URI . '/users/' . USERNAME . '/login?password=' . PASSWORD;

      $response = $this->client->request('POST', $authuri, [
        'on_stats' => function (GuzzleHttp\TransferStats $stats) use (&$url) {
          $url = $stats->getEffectiveUri();
        }]);

      //echo "Sending request to " . $url . "\n";
    } catch (GuzzleHttp\Exception\ServerException $e) {
    } catch (GuzzleHttp\Exception\ClientException $e) {
      throw new Exception("Unable to authenticate:\n" . $e); // non available page!
    }
    if ($response->getStatusCode() == 200) {
      //echo "Successfully authenticated!\n";
      $data = json_decode($response->getBody(), true);
      $this->session_id = $data['session']; // make a test for this      
      //echo "Session id " . $this->session_id . " saved.\n";
    } else {
      throw new Error("Something went wrong with your request. Unable to authenticate.\n");
    }
  }

  /**
  * Get data from an ArchiveSpace Digital Object by id
  */
  public function getDigitalObject(int $digitalobject_id) {
    $url = BASE_URI . '/repositories/' . REPO_ID . '/digital_objects/' . $digitalobject_id;

    try {
      $response = $this->client->request('GET', $url, [
        'headers' => ['X-ArchivesSpace-Session' => $this->session_id],
        'on_stats' => function (GuzzleHttp\TransferStats $stats) use (&$url) {
          $url = $stats->getEffectiveUri();
        }]);
    } catch (GuzzleHttp\Exception\ClientException $e) {
        echo ("Unable to reach server: \n" . $e);
        throw new Exception($e);
      die(); // make this a retry with a recurs limit
    }

    if ($response->getStatusCode() == 200) {
      //echo "Successfully retrieved digital object!\n";
      $data = json_decode($response->getBody(), true);
      //var_dump($data);
      return($data);
    } else {
      throw new Error("Something went wrong with your request. Unable to get digital object.\n");
    }
  }

  /**
  * Get data from an ArchiveSpace Archival Object by id
  */
  public function getArchivalObject(int $archivalobject_id) {
    $url = BASE_URI . '/repositories/' . REPO_ID . '/archival_objects/' . $archivalobject_id;

    try {
      $response = $this->client->request('GET', $url, [
        'headers' => ['X-ArchivesSpace-Session' => $this->session_id],
        'on_stats' => function (GuzzleHttp\TransferStats $stats) use (&$url) {
          $url = $stats->getEffectiveUri();
        }]);
    } catch (GuzzleHttp\Exception\ClientException $e) {
        throw new Exception($e);
        echo ("Unable to reach server:\n" . $e);
    }

    if ($response->getStatusCode() == 200) {
      //echo "Successfully retrieved archival object!\n";
      $data = json_decode($response->getBody(), true);
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
      // possibly limit to subject tag "retrotech" and "published"
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
      $i++;
    }
  }

  public function getResourceById(int $id, bool $get_tree = false) {
    if ($get_tree) {
      $url = BASE_URI . '/repositories/' . REPO_ID . '/resources/' . $id . '/tree';
    } else {
      $url = BASE_URI . '/repositories/' . REPO_ID . '/resources/' . $id;
    }

    try {
      $response = $this->client->request('GET', $url, [
        'headers' => ['X-ArchivesSpace-Session' => $this->session_id],
        'on_stats' => function (GuzzleHttp\TransferStats $stats) use (&$url) {
          $url = $stats->getEffectiveUri();
        }]);
    } catch (GuzzleHttp\Exception\ClientException $e) {
      echo "There was a problem with your request.\n";
      //echo 'HTTP request URL: ' . $url . "\n";
      //echo 'HTTP response status: ' . $e->getResponse()->getStatusCode() . "\n";
      echo 'Exception: ' . $e->getMessage() . "\n";
      throw new Exception($e);
    }

    if ($response->getStatusCode() == 200) {
      //echo "Successfully retrieved container!\n";
      $data = json_decode($response->getBody(), true);
      return($data);
    } else {
      throw new Error("Something went wrong with your request. Unable to get top container.\n");
    }
  }

  /**
  * Get data from an ArchiveSpace Agent by id
  */
  public function getAgentById(int $id) {
    $url = BASE_URI . '/agents/people/' . $id;

    try {
      $response = $this->client->request('GET', $url, [
        'headers' => ['X-ArchivesSpace-Session' => $this->session_id],
        'on_stats' => function (GuzzleHttp\TransferStats $stats) use (&$url) {
          $url = $stats->getEffectiveUri();
        }]);
    } catch (GuzzleHttp\Exception\ClientException $e) {
      throw new Exception('Guzzle Error: ' . $e);
    }

    if ($response->getStatusCode() == 200) {
      //echo "Successfully retrieved agent!\n";
      $data = json_decode($response->getBody(), true);
      return($data);
    } else {
      throw new Error("Something went wrong with your request. Unable to get person.\n");
    }
  }

  /**
  * Handle request to ArchiveSpace server for archival object
  */
  public function serveASpaceDataFromAO(int $ao_id) {
    $cli = new ArchiveSpaceApi();
    $cli->authenticate();
    // Fetch archival object from id given as route url parameter
    $ao = $cli->getArchivalObject($ao_id);
    return $ao;
  }

  /**
  * Handle request to ArchiveSpace server for resource
  */
  public function serveASpaceDataFromResource(int $r_id) {
    $cli = new ArchiveSpaceApi();
    $cli->authenticate();
    $resource = $cli->getResourceById($r_id);
    return $resource;

  }
}

?>
<?php

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;

class ArchiveSpaceApi {
  var $client;
  var $session_id;

  static function _getIDFromUrl(string $url) {
    $exploded_url = explode('/', $url);
    $len = sizeof($exploded_url);
    return $exploded_url[$len - 1];
  }

  private static function _formatName(string $name) {
    $newname = explode(', ', $name);
    $newname = array_reverse($newname);
    return implode(' ', $newname);

  }

  # create Guzzle client for HTTP requests
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
      die(); // use retry with recurs limit
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

  public function getArchivalObject(int $archivalobject_id) {
    $url = BASE_URI . '/repositories/' . REPO_ID . '/archival_objects/' . $archivalobject_id;

    try {
      $response = $this->client->request('GET', $url, [
        'headers' => ['X-ArchivesSpace-Session' => $this->session_id],
        'on_stats' => function (GuzzleHttp\TransferStats $stats) use (&$url) {
          $url = $stats->getEffectiveUri();
        }]);
    } catch (GuzzleHttp\Exception\ClientException $e) {
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
      die(); // make this a retry with a recurs limit
    }

    if ($response->getStatusCode() == 200) {
      echo "Successfully retrieved container!\n";
      $data = json_decode($response->getBody(), true);
      return($data);
    } else {
      throw new Error("Something went wrong with your request. Unable to get top container.\n");
    }
  }

  public function getAgentById(int $id) {
    $url = BASE_URI . '/agents/people/' . $id;

    try {
      $response = $this->client->request('GET', $url, [
        'headers' => ['X-ArchivesSpace-Session' => $this->session_id],
        'on_stats' => function (GuzzleHttp\TransferStats $stats) use (&$url) {
          $url = $stats->getEffectiveUri();
        }]);
    } catch (GuzzleHttp\Exception\ClientException $e) {
      die(); // make this a retry with a recurs limit
    }

    if ($response->getStatusCode() == 200) {
      //echo "Successfully retrieved archival object!\n";
      $data = json_decode($response->getBody(), true);
      return($data);
    } else {
      throw new Error("Something went wrong with your request. Unable to get person.\n");
    }
  }

  public function serveASpaceDataFromDO(int $do_id) {
    $cli = new ArchiveSpaceApi();
    $cli->authenticate();
    // Fetch digital object from id given as route url parameter
    $do = $cli->getDigitalObject($do_id);
    $ao = $cli->getArchivalObjectFromDigitalObject($do);
    $data = array("entry_name"        => $ao['display_string'],
                  "entry_date"        => $ao['dates'][0]['expression'],
                  "entry_description" => (empty($do['notes']) ? 'Visit to learn more': $do['notes']),
                  "emulation_url"     => $do['digital_object_id']);
    return $data;
  }

  public function serveASpaceDataFromAO(int $ao_id) {
    $cli = new ArchiveSpaceApi();
    $cli->authenticate();
    // Fetch archival object from id given as route url parameter
    $ao = $cli->getArchivalObject($ao_id);
    return $ao;
  }

  public function serveASpaceDataFromResource(int $r_id) {
    $cli = new ArchiveSpaceApi();
    $cli->authenticate();
    $resource = $cli->getResourceById($r_id);
    
    //$resource_children = $cli->getObjectsFromTree($cli->getResourceById($r_id, true));
    //$agent = $cli->getAgentById(ArchiveSpaceApi::_getIDFromUrl($ao['linked_agents'][0]['ref']));

    // $data = array("entry_name"        => $resource['title'],
    //               "entry_title"       => $resource['title'],
    //               "entry_date"        => $resource['dates'][0]['expression'],
    //               "entry_description" => (empty($resource['notes'][1]['subnotes'][0]['content']) ? 'Visit to learn more': $resource['notes'][1]['subnotes'][0]['content']),
    //               "software_url"     => (empty($resource['external_documents'][0]['location'])) ? 'Link coming soon': $resource['external_documents'][0]['location']);
    return $resource;

  }
}

?>
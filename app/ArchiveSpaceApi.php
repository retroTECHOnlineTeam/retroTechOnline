<?php

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;

class ArchiveSpaceApi {
  var $client;
  var $session_id;

  private static function _getIDFromUrl(string $url) {
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
      //echo "The server is unavailable.\n";
    } catch (GuzzleHttp\Exception\ClientException $e) {
      //echo "There was a problem with your request.\n";
      //echo 'HTTP request URL: ' . $url . "\n";
      //echo 'HTTP response status: ' . $e->getResponse()->getStatusCode() . "\n";
      //echo 'Exception: ' . $e->getMessage() . "\n";
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
      //echo "There was a problem with your request.\n";
      //echo 'HTTP request URL: ' . $url . "\n";
      //echo 'HTTP response status: ' . $e->getResponse()->getStatusCode() . "\n";
      //echo 'Exception: ' . $e->getMessage() . "\n";
      die(); // make this a retry with a recurs limit
    }

    if ($response->getStatusCode() == 200) {
      //echo "Successfully retrieved resource!\n";
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
      //echo "There was a problem with your request.\n";
      //echo 'HTTP request URL: ' . $url . "\n";
      //echo 'HTTP response status: ' . $e->getResponse()->getStatusCode() . "\n";
      //echo 'Exception: ' . $e->getMessage() . "\n";
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
      //echo "There was a problem with your request.\n";
      //echo 'HTTP request URL: ' . $url . "\n";
      //echo 'HTTP response status: ' . $e->getResponse()->getStatusCode() . "\n";
      //echo 'Exception: ' . $e->getMessage() . "\n";
      die(); // make this a retry with a recurs limit
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
      //echo("Object ".$i.":\n");
      //echo($obj['title']."\n");
      //echo($obj['digital_object_id']."\n");
      $i++;
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
      //echo "There was a problem with your request.\n";
      //echo 'HTTP request URL: ' . $url . "\n";
      //echo 'HTTP response status: ' . $e->getResponse()->getStatusCode() . "\n";
      //echo 'Exception: ' . $e->getMessage() . "\n";
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
    $history_obj = $cli->getDigitalObject(ArchiveSpaceApi::_getIDFromUrl($ao['instances'][1]['digital_object']['ref']));
    $software_obj =$cli->getDigitalObject(ArchiveSpaceApi::_getIDFromUrl($ao['instances'][0]['digital_object']['ref']));
    $agent = $cli->getAgentById(ArchiveSpaceApi::_getIDFromUrl($ao['linked_agents'][0]['ref']));

    $data = array("entry_name"        => $ao['display_string'],
                  "entry_title"       => $ao['title'],
                  "entry_date"        => $ao['dates'][0]['expression'],
                  "entry_description" => (empty($ao['notes'][0]['subnotes'][0]['content']) ? 'Visit to learn more': $ao['notes'][0]['subnotes'][0]['content']),
                  "emulation_url"     => $software_obj['external_documents'][0]['location'],
                  "history_url"     => $history_obj['external_documents'][0]['location'],
                  "agent_name"        => ArchiveSpaceApi::_formatName($agent['title']));
    return $data;
  }
}

?>
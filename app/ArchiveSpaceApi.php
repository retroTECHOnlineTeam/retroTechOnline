<?php
require './vendor/autoload.php';
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
    include './api_creds_prod.php';

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

  public function getResource(int $repo_id, int $record_id) {
    $url = BASE_URI . '/repositories/' . $repo_id . '/resources/' . $record_id;
    //$url = BASE_URI . '/repositories/' . $repo_id . '/resources?all_ids=true';

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
      var_dump($data);
    } else {
      throw new Error("Something went wrong with your request. Unable to get resource.\n");
    }
  }

  public function getDigitalObject(int $repo_id, int $digitalobject_id) {
    $url = BASE_URI . '/repositories/' . $repo_id . '/digital_objects/' . $digitalobject_id;

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
      var_dump($data);
    } else {
      throw new Error("Something went wrong with your request. Unable to get digital object.\n");
    }
  }

}

  echo "TESTING START!\n";
  $c = new ArchiveSpaceApi();
  $c->authenticate();
  $c->getDigitalObject(2, 5080);
  echo "TEST DONE!\n";
?>
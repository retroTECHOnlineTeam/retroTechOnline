<?php
require './vendor/autoload.php';
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;

class ArchiveSpaceApi {
  var $client;
  var $session;

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
    include './api_creds.php';

    try {
      $authuri = BASE_URI . '/users/' . USERNAME . '/login?password=' . PASSWORD;

      $response = $this->client->request('POST', $authuri, [
        'on_stats' => function (GuzzleHttp\TransferStats $stats) use (&$url) {
          $url = $stats->getEffectiveUri();
        }]); // sanitize this!

      echo "Sending request to " . $url . "\n";
    } catch (GuzzleHttp\Exception\ServerException $e) {
      echo "The server is unavailable.\n";
    } catch (GuzzleHttp\Exception\ClientException $e) {
      echo "There was a problem with your request.\n";
      echo 'HTTP request URL: ' . $url . "\n";
      //echo 'HTTP request: ' . $e->getRequest() . "\n";
      echo 'HTTP response status: ' . $e->getResponse()->getStatusCode() . "\n";
      //echo 'HTTP response: ' . $e->getResponse()->getBody(true) . "\n";
      echo 'Exception: ' . $e->getMessage() . "\n";
      die(); // maybe don't do this?
    }
    if ($response->getStatusCode() == 200) {
      echo "Successfully authenticated!\n";
      $data = json_decode($response->getBody(), true);
      $this->session = $data['session']; // make a test for this
      echo "Session saved.\n";
    } else {
      throw new Error("Something went wrong with your request. Unable to authenticate.\n");
    }
  }

  public function getDigitalObjects() {
    $res = $client->request('POST', '/repositories/2/digial_objects?all_ids=true', [
        'form_params' => [
            'client_id' => 'test_id',
            'secret' => 'test_secret',
        ]
    ]);
    echo $res->getStatusCode();
    // 200
    echo $res->getHeader('content-type');
    // 'application/json; charset=utf8'
    echo $res->getBody();
    // {"type":"User"...'
  }

}

  echo "here we go!\n";
  $c = new ArchiveSpaceApi();
  $c->authenticate();
  echo "DONE!\n";
?>
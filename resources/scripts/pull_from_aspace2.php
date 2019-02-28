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
      'base_uri' => 'https://as-stage-backend.library.gatech.edu',
      'connect_timeout' => 2.0,
      'on_stats' => function (GuzzleHttp\TransferStats $stats) use (&$url) {
        $url = $stats->getEffectiveUri(); }
    ]);
    echo "Guzzle client created.\n";
  }

  public function authenticate() {
    include './api_creds.php';

    try {
      $authuri = 'https://as-stage-backend.library.gatech.edu/users/'
                  .$username.'/login?password='.$password;
      echo $authuri; // for testing

      $response = $this->client->request('POST', $authuri, [
        'on_stats' => function (GuzzleHttp\TransferStats $stats) use (&$url) {
          $url = $stats->getEffectiveUri();
        }]); // sanitize this!

      echo "Sending request to " . $url;
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
      // save session info here
      $data = json_decode($response->getBody(), true);
      $this->session = $data['session']; // make a test for this
      echo "Session saved.";
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
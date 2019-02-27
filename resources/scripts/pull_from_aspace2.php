<?php
require './vendor/autoload.php';
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;

class ArchiveSpaceApi {
  var $client;

  # create Guzzle client for HTTP requests
  public function __construct() {
    $this->client = new Client([
      // Base URI is used with relative requests
      'base_uri' => 'https://as-stage-backend.library.gatech.edu',
      'auth' => [$username, $password],
      'connect_timeout' => 2.0,
      'username' => $username,
        'password' => $password,
        'on_stats' => function (GuzzleHttp\TransferStats $stats) use (&$url) {
          $url = $stats->getEffectiveUri(); }
    ]);
    echo "Guzzle client created.\n";
  }

  public function authenticate() {
    include './api_creds.php';

    try {
      $request = new Request('POST', '/users/'.$username.'/login?password='.$password, array(
        'username' => $username,
        'password' => $password,
        'on_stats' => function (TransferStats $stats) use (&$url) {
          $url = $stats->getEffectiveUri();
        })); // sanitize this!

      $response = $this->client->request($request);

      echo $url;
      die();
    } catch (GuzzleHttp\Exception\ConnectException $e) {
        echo "The server is unreachable at the time. Please contact support.\n";
    } catch (GuzzleHttp\Exception\ServerException $e) {
        echo "The server is unreachable at the time. Please contact support.\n";
        echo 'Exception: ' . $e->getMessage();
        //echo 'HTTP request URL: ' . $e->getRequest()->getUrl() . "\n";
        //echo 'HTTP request: ' . $e->getRequest() . "\n";
        echo 'HTTP response status: ' . $e->getResponse()->getStatusCode() . "\n";
        //echo 'HTTP response: ' . $e->getResponse()->getBody(true) . "\n";
        die(); // maybe don't do this
    } catch (GuzzleHttp\Exception\ClientException $e) {
      echo "You messed up your request.\n";
      echo 'HTTP response status: ' . $e->getResponse()->getStatusCode() . "\n";
      echo 'Exception: ' . $e->getMessage();
      die();
    }
    if ($res->getStatusCode() == 200) {
      echo "Authenticated! :)\n";
    }
    // 200
    //echo $res->getHeader('content-type');
    // 'application/json; charset=utf8'
    //echo $res->getBody();
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
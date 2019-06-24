<?php

require 'vendor/autoload.php';


use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;

class OHMSParser {
	var $client;

	public function __construct() {
		$this->client = new Client([
	      'base_uri' => 'https://apps-stage.library.gatech.edu',
	      'verify' => false, // check this
	      'connect_timeout' => 2.0,
	      'on_stats' => function (GuzzleHttp\TransferStats $stats) use (&$url) {
	        $url = $stats->getEffectiveUri(); }
	    ]);
	}

}

$a = new OHMSParser();
$res = $a->client->request('GET', '/ohms/viewer.php?cachefile=Lance-Fortnow-oral-history-interview_20181107.xml');
$b = (string) $res->xml();
var_dump($b);

?>
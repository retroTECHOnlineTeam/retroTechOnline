<?php
ob_start(); //Turning ON Output Buffering

$session = '';

# authenticate user
$aspace_url = 'http://localhost:8089';
$repository_id = '1';
$username= 'admin';
$password = 'admin';

$auth = $aspace_url.'/users/'.$username.'/login?password='.$password;
$session = $auth['session'];


# get the ids for digital objects in the repository
$curl = curl_init();
curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
curl_setopt($curl, CURLOPT_USERPWD, $username.":".$password);
curl_setopt($curl, CURLOPT_URL, $aspace_url."/repositories/".$repository_id."/digital_objects?all_ids=true");

$ret = curl_exec($curl);
$object_ids = json_decode($ret,true);

echo $result['someData'] . "<br>";
curl_close($curl);


# get the digital object for each id
 foreach ($object_ids as $id)
 {
  $curl = curl_init();
  curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
  curl_setopt($curl, CURLOPT_USERPWD, $username.":".$password);
  curl_setopt($curl, CURLOPT_URL, $aspace_url."repositories/".$repository_id."/digital_objects/".$id);

  $ret = curl_exec($curl);
  $results = json_decode($ret,true);

  ob_flush();//Flush the data here
  foreach ($results as $object) {
  	  echo $object . "<br>";
  }
  curl_close($curl);
 }
 ob_end_flush();

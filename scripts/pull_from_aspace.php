<?php
ob_start(); //Turning ON Output Buffering

$session = '';

# authenticate user
# curl -F password=quie8eeN_ooPh "https://as-stage-backend.library.gatech.edu/users/gtlib_api_user/login"
$aspace_url = 'https://as-stage-backend.library.gatech.edu';
$repository_id = '2';
$username= 'gtlib_api_user';
$password = 'quie8eeN_ooPh';

$auth = curl_init();
//curl_setopt($auth, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
curl_setopt($auth,CURLOPT_FAILONERROR,true);
curl_setopt($auth, CURLOPT_USERPWD, $username.":".$password);
curl_setopt($auth, CURLOPT_URL, $aspace_url.'/users/'.$username.'/login?password='.$password);
curl_setopt($auth, CURLOPT_URL, $aspace_url.'/users/'.$username.'/login');

// //
// $auth_res = curl_exec($auth);
// $temp = json_decode($auth_res, true); // NOT WORKING
// curl_close($auth);
// //

curl_exec($auth);
if (curl_error($auth)) {
    $error_msg = curl_error($auth);
}
curl_close($auth);

if (isset($error_msg)) {
    throw new Exception('Authentication Failed: '.$error_msg);
}

#$auth = curl_setopt($curl, CURLOPT_URL $aspace_url.'/users/'.$username.'/login?password='.$password);
$session = $auth_result['session'];

if (empty($session)) {
	throw new Exception('Authentication Failed! '.$temp);
} else {
	echo "Successfully authenticated user ".$username."\n";
	echo $session;
}

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

  foreach ($results as $object) {
  	  echo $object . "<br>";
  }
  curl_close($curl);
 }
 ob_end_flush();

 ?>

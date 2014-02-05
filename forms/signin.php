<?php

session_start();

//Load in the current users
$file = "users.json";
$string = file_get_contents($file);
$users=json_decode($string,true);
$tokenfile = "tokens.json";
$string = file_get_contents($file);
$tokens=json_decode($string,true);

$username = $_POST['username'];

//Check to see if the username exists
foreach($users as $name){
	if($name == $username){
		$_SESSION['username'] = $username;
		if(isset($tokens[$username])){
			$_SESSION['token'] = $tokens[$username];
		}
		die(json_encode(array('type' => 'Success')));
	}
}

//If not, return an error
die(json_encode(array('type' => 'Error','message' => 'Username does not exist')));

?>
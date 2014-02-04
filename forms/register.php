<?php

session_start();

//Load in the current users
$file = "users.json";
$string = file_get_contents($file);
$users=json_decode($string,true);

if($users == null){
	$users = array();
}

$newUser = $_POST['username'];

//Check to see if the username already exists
foreach($users as $name){
	if($name == $newUser){
		die(json_encode(array('type' => 'Error','message' => 'This username already exists. Choose a new username.')));
	}
}

//Add the new user
array_push($users,$newUser);

//Save the users
file_put_contents($file, json_encode($users));

die(json_encode(array('type' => 'Success')));

?>
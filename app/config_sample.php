<?php


// Database Configuration
$dbinfo = [
  'host' => 'RHOST', // Your mySQL Host (usually Localhost)
  'username' => 'RUSER', // Your mySQL Databse username
  'password' => 'RPASS', //  Your mySQL Databse Password
  'db' => 'RDB' // The database where you have dumped the included sql file
];


$config = [
  'timezone' => date_default_timezone_get(),
  'debug' => true,
  'streamMethod' => 'flash',
  'mdl'  => true
];

//for developers
define('API_KEY','1234');



function dnd($data){
  echo '<pre>';
  print_r($data);
  echo '</pre>';
  die();
}


if(strpos($_SERVER['REQUEST_URI'], '/updater.php') === false)
{
  include ('inc/core.php');
}





<?php

$host = 'localhost';
$user = 'root';
$password = '';
$database = 'sir1';

$connection = mysqli_connect($host, $user ,$password, $database);

if (mysqli_connect_error()) {
    echo "error: unable to ceonnect to MYSQL <br>";
    echo "message: ".mysqli_connect_error(),"<br>";
}
//to check the database connection
//else{
  //  echo "successfully connected to your database";

//}
  
?>
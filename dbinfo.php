<?php

$host = "localhost";
$username = "root";
$password = "";
$dbname = "jashandeep";
$database = 'jashandeep';
$con = mysqli_connect($host, $username, $password, $dbname);

if (!$con)
{
    die("Connection failed!" . mysqli_connect_error());
}

?>

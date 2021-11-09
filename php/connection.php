<?php

$dbhost = 'localhost';

$dbuser = 'root';
$dbpass = '';

$conn = new mysqli($dbhost, $dbuser, $dbpass);

$value = mysqli_select_db($conn, 'newgamesdb');

?>
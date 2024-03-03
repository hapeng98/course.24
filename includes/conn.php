<?php
$servername='localhost';
$username='root';
$password='smiler042^^';
$dbname='course';
$conn=mysqli_connect($servername, $username, $password, $dbname);
if(!$conn){
    die("Connection failed: " .mysqli_connect_error());
}

?>
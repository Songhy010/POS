<?php 
$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "@coffeedb";
$conn=mysqli_connect($servername,$username,$password,$dbname);

if(!$conn){
die("DB conn fail" .mysqli_connect_error());
}

?>
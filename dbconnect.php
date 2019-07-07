<?php 
$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "id6467379_coffee";
$conn=mysqli_connect($servername,$username,$password,$dbname);

if(!$conn){
die("DB conn fail" .mysqli_connect_error());
}

?>
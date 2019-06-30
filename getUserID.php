<?php
include "dbconnect.php";
if($_SERVER['REQUEST_METHOD']=="GET"){
    $username = $_GET["USER"];
	$password= $_GET["PASS"];
	    $sql = "SELECT user_id FROM users WHERE user_name = '$username' AND user_password = '$password'";

	    $stmt = mysqli_query($conn, $sql);
	    $result = array(); 
    		while ($row = mysqli_fetch_array($stmt)){
				$result[] = $row;
    		}

header('Content-Type:application/json');
echo json_encode(array("product"=>$result));
//mysqli_free_stmt($stmt);
mysqli_close($conn);	
}
?>
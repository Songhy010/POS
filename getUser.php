<?php
include "dbconnect.php";
if($_SERVER['REQUEST_METHOD']=="GET"){
	//$para = $_GET["CAT"];
	    $sql = "SELECT user_name,user_password FROM USERS WHERE user_type = 'User'";

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
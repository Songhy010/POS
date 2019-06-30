<?php
include "dbconnect.php";
if($_SERVER['REQUEST_METHOD']=="POST"){
    $waitNB = $_POST["WNB"];

	    $sql = "UPDATE waiting_number SET isbusy= 1 where waiting_num = '$waitNB'";

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
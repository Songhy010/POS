<?php
include "dbconnect.php";
if($_SERVER['REQUEST_METHOD']=="GET"){
	//$para = $_GET["CAT"];
	    $sql = "SELECT waiting_num FROM waiting_number";

	    $stmt = mysqli_query($conn, $sql);
	    $result = array(); 
    		while ($row = mysqli_fetch_array($stmt)){
				$result[] = $row;
    		}
header('Content-Type:application/json');
echo json_encode(array("wait"=>$result));
//mysqli_free_stmt($stmt);
mysqli_close($conn);
}
?>
<?php
include "dbconnect.php";
if($_SERVER['REQUEST_METHOD']=="POST"){
    	$rid = $_POST["RID"];
	$status = $_POST["STA"];

	    $sql = "UPDATE record_orders SET record_orders.record_ispaid = $status WHERE record_orders.record_id = $rid";

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
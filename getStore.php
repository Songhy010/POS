<?php
include "dbconnect.php";
if($_SERVER['REQUEST_METHOD']=="GET"){
    $storeid = $_GET["SID"];

	    $sql = "SELECT store_name,store_long,store_lat,store_phone, store_close, store_discount, store_status FROM store where store_id= '$storeid'";

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
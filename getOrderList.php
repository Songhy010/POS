<?php
include "dbconnect.php";
if($_SERVER['REQUEST_METHOD']=="GET"){
		$wnb = $_GET["WNB"];
	    $sql = "SELECT
                product.product_id,
                product.product_name,
                size.size,
                orders.order_productprice,
                orders.order_quantity,
                orders.order_description,
                record_orders.record_total,
                record_orders.record_id FROM record_orders 
            INNER JOIN orders ON record_orders.record_id = orders.order_recordid
            INNER JOIN product ON orders.order_productid = product.product_id   
            INNER JOIN size ON size.size_id = orders.order_size WHERE record_orders.record_waitingNb = '$wnb' AND record_orders.record_ispaid = 0";

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
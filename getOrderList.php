<?php
include "dbconnect.php";
if($_SERVER['REQUEST_METHOD']=="GET"){
		$para = $_GET["ISP"];
	    $sql = "SELECT orders.order_productid,product.product_name,size.size,product_prices.prices,orders.order_productprice,
        orders.order_description,orders.order_amount FROM orders INNER JOIN record_orders 
        ON orders.order_recordid = record_orders.record_id INNER JOIN product 
        ON orders.order_productid = product.product_id INNER JOIN size 
        ON orders.order_size = size.size_id INNER JOIN product_prices 
        ON orders.order_productprice = product_prices.prices_id WHERE record_orders.record_ispaid ='$para'";

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
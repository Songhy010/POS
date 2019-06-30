<?php
include "dbconnect.php";
if($_SERVER['REQUEST_METHOD']=="GET"){
		$para = $_GET["NAME"];
	    $sql = "SELECT product_id,product_name,category.category FROM product INNER JOIN category ON product.product_category = category.category_id WHERE product.product_name LIKE '%$para%'";

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
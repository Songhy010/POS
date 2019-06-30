<?php
include "dbconnect.php";
 if($_SERVER['REQUEST_METHOD']=="POST"){
	$alert=array("Success");
	$rid = $_POST['RID'];
	$pid = $_POST['PID'];
	$pri = $_POST['PRI'];
	$qty = $_POST['QTY'];
	$amn = $_POST['AMN'];
	$dis = $_POST['DIS'];
	$siz = $_POST['SIZ'];
	$des = $_POST['DES'];
	$isd = $_POST['ISD'];
	
	$sql = "INSERT INTO ORDERS(
  order_recordid,
  order_productid,
  order_productprice,
  order_quantity,
  order_amount,
  order_discount,
  order_size,
  order_description,
  order_isdelete) VALUES($rid,$pid,$pri,$qty,$amn,$dis,$siz,'$des','$isd')";
	mysqli_query($conn, $sql);
	echo json_encode(array("alert"=>$alert));
	mysqli_close($conn);
}
?>
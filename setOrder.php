<?php
include "dbconnect.php";
 if($_SERVER['REQUEST_METHOD']=="POST"){
	$alert=array("Success");
	$rid = $_POST['RID'];
	$uid = $_POST['UID'];
	$sid = $_POST['SID'];
	$log = $_POST['LOG'];
	$lat = $_POST['LAT'];
	$tot = $_POST['TOT'];
	$isc = $_POST['ISC'];
	$isp = $_POST['ISP'];
	$isy = $_POST['ISY'];
	$isv = $_POST['ISV'];
	$isd = $_POST['ISD'];
  $tok = $_POST['TOK'];
  $wait = $_POST['WAIT'];
	$sql = "INSERT INTO RECORD_ORDERS (
                record_id,
                record_userid,
                record_storeid,
  				      record_date,
                record_long,
                record_lat,
                record_total,
                record_isconfirm,
                record_ispaid,
                record_isdelivery,
                record_isdeliveried,
                record_isdelete,
                record_token,
                record_waitingNb) 
            VALUES(
                $rid,
                $uid,
                $sid,
              	NOW(),
                $log,
                $lat,
                $tot,
                $isc,
                $isp,
                $isy,
                $isv,
                $isd,
                '$tok',
                '$wait')";
	mysqli_query($conn, $sql);
	echo json_encode(array("alert"=>$alert));
	mysqli_close($conn);
}
?>
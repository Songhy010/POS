<?php 
include('dbconnect.php');
$para =$_POST['PRO'];
$paraS =$_POST['SIZE'];

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "SELECT product_prices.prices FROM product INNER JOIN product_prices ON product.product_id=product_prices.prices_productid INNER JOIN size ON product_prices.prices_sizeid=size.size_id 
        where product.product_name = '$para' AND size.size='$paraS'";
$result = $conn->query($sql);		  
    while ($row = mysqli_fetch_array($result))
    {  
          echo $row['prices'];
    }
?>
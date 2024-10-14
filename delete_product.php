<?php
    require('database.php');

	$id = $_GET['product'];

	$del_query="DELETE FROM product WHERE product_id='$id'";
    mysqli_query($con, $del_query) or die(mysqli_error($con));

	header('location:product.php');
?>
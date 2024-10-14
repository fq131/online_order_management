<?php
    require('database.php');

	$id=$_GET['product'];
	$product_name=$_POST['product_name'];
	$category=$_POST['category'];
	$price=$_POST['price'];
	$status=$_POST['status'];

	// Get the product information
	$sel_query="SELECT * FROM product WHERE product_id='$id'";
    $result = mysqli_query($con,$sel_query);
    $row = mysqli_fetch_assoc($result);
	$fileinfo=PATHINFO($_FILES["photo"]["name"]);

	if (empty($fileinfo['filename'])){
		$location = $row['photo'];
	}
	else{
		$newFilename=$fileinfo['filename'] ."_". time() . "." . $fileinfo['extension'];
		move_uploaded_file($_FILES["photo"]["tmp_name"],"upload/" . $newFilename);
		$location="upload/" . $newFilename;
	}

	// Update the product information
	$up_sql="UPDATE product SET product_name='$product_name', category_id='$category', price='$price', status='$status', photo='$location' WHERE product_id='$id'";
	mysqli_query($con, $up_sql) or die(mysqli_error($con));

	header('location:product.php');
?>
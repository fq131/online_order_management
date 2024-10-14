<?php
    require('database.php');
    $status = "";

	$product_name=$_POST['product_name'];
	$category=$_POST['category'];
	$price=$_POST['price'];
	$status=$_POST['status'];
	$timestamp_record = date("Y-m-d H:i:s");
	$fileinfo=PATHINFO($_FILES["photo"]["name"]);

	
	if(empty($fileinfo['filename'])){
		$location="";
	}
	else{
	$newFilename=$fileinfo['filename'] ."_". time() . "." . $fileinfo['extension'];
	move_uploaded_file($_FILES["photo"]["tmp_name"],"upload/" . $newFilename);
	$location="upload/" . $newFilename;
	}
	
	// Query to add product
	$add_query="INSERT INTO product (product_name, category_id, price, status, timestamp_record, photo) 
				VALUES ('$product_name', '$category', '$price', '$status', '$timestamp_record', '$location')";
	mysqli_query($con, $add_query) or die(mysqli_error($con));

	header('location:product.php');
	$status = "New Product Inserted Successfully.
	</br></br><a href='view.php'>View Product Record</a>";

?>
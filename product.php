<!DOCTYPE html>
<html>
<head>
<?php include('header.php'); ?>
<?php require('database.php');?>
</head>
<body>
<div class="container">
	<h1 class="page-header text-center">Product Edit Page</h1>
	<div class="row">
		<div class="col-md-12 d-flex justify-content-between">
		<a class="btn btn-primary" href="admin_dashboard.php">Back</a>
		<div>
			<a data-bs-toggle="modal" data-bs-target="#addproduct" class="btn btn-primary"><i class="bi bi-plus-lg"></i> Product</a>
			<?php include('modal.php'); ?>
		</div>
	</div>
	</div>
	<div style="margin-top:10px;">
		<!-- Table to display product detail -->
		<table class="table table-bordered table-hover">
			<thead class="table-dark">
                <tr>
                    <th scope="col">Photo</th>
                    <th scope="col">Product Name</th>
                    <th scope="col">Category</th>
                    <th scope="col">Price</th>
					<th scope="col">Status</th>
                    <th scope="col">Action</th>
                </tr>
			</thead>
			<tbody>
				<?php

					// SQL to fetch product detail
					$sel_query="SELECT * FROM product LEFT JOIN category ON category.category_id=product.category_id ORDER BY product.category_id ASC, product_name ASC";
                    $result = mysqli_query($con,$sel_query);
	
					while($row = mysqli_fetch_assoc($result)){
						?>
						<tr>
							<td><a href="<?php if(empty($row['photo'])){echo "upload/noimage.jpg";} else{echo $row['photo'];} ?>"><img src="<?php if(empty($row['photo'])){echo "upload/noimage.jpg";} else{echo $row['photo'];} ?>" height="130px" width="180px"></a></td>
							<td><?php echo $row['product_name']; ?></td>
                            <td><?php echo $row['category_name']; ?></td>
							<td>RM <?php echo number_format($row['price'], 2); ?></td>
							<td>
								<?php
									if ($row['status'] == 'Active') {
										// Show icon for Active status
										echo '<i class="bi bi-check-circle-fill" style="color: green;"></i>';
									} else {
										// Show icon for Inactive status
										echo '<i class="bi bi-x-circle-fill" style="color: red;"></i>';
									}
								?>
							</td>
							<td>
								<!-- Button for Edit and Delete -->
								<a data-bs-toggle="modal" data-bs-target= "#edit_product<?php echo $row['product_id']; ?>" class="btn btn-success btn-sm"><i class="bi bi-pen-fill"></i> Edit</a>  
                                <a data-bs-toggle="modal" data-bs-target= "#delete_product<?php echo $row['product_id']; ?>" class="btn btn-danger btn-sm"><i class="bi bi-trash3-fill"></i> Delete</a>
							    <?php include('product_modal.php'); ?>
                                
							</td>
						</tr>
						<?php
					}
				?>
			</tbody>
		</table>
	</div>
</div>
<?php include('modal.php'); ?>
<?php include('footer.php'); ?>

</body>
</html>

<head>
	<?php require('header.php'); ?>
	<?php require('database.php');?>
</head>
<body>

<!--Style for Product Image-->
<style>
	.card-img-top {
	    width: 100%;
	    height: 13rem;
	    object-fit: cover;
	}
</style>
<div class="container">
	<h1 class="page-header text-center">Product Menu</h1>
	<ul class="nav nav-tabs" id="myTab" role="tablist">
		<?php

			// Displaying the first category name
			$tquery="SELECT * FROM category ORDER BY category_id ASC LIMIT 1";
            $fresult = mysqli_query($con,$tquery);
            $frow = mysqli_fetch_assoc($fresult)

			?>
				<li class="nav-item" role="presentation">
					<a class="nav-link active" data-bs-toggle="tab" data-bs-target="#<?php echo $frow['category_name'] ?>"><?php echo $frow['category_name'] ?></a>
				</li>
			<?php

			// Get the total number of category
            $nquery="SELECT * FROM category ORDER BY category_id ASC";
            $nresult = mysqli_query($con,$nquery);
			$num=$nresult->num_rows-1;

			// Displaying other category name
            $nquery="SELECT * FROM category ORDER BY category_id ASC LIMIT 1, $num";
            $nresult = mysqli_query($con,$nquery);
            while($nrow = mysqli_fetch_assoc($nresult)){
				?>
				<li class="nav-item">
					<a class="nav-link" data-bs-toggle="tab" data-bs-target="#<?php echo $nrow['category_name'] ?>"><?php echo $nrow['category_name'] ?></a>
				</li>
				<?php
			}
		?>
	</ul>

	<div class="tab-content" id="myTabContent">
		<?php

            $tquery="SELECT * FROM category ORDER BY category_id ASC LIMIT 1";
            $fresult = mysqli_query($con,$tquery);
            $frow = mysqli_fetch_assoc($fresult);

			?>
				<div id="<?php echo $frow['category_name']; ?>" class="tab-pane fade show active" style="margin-top:20px;" role="tabpanel">
					<?php

						// Displaying product for the first category
                        $pquery="SELECT * FROM product WHERE category_id='".$frow['category_id']."'";
                        $presult = mysqli_query($con,$pquery);
						$inc=4;

						while($prow = mysqli_fetch_assoc($presult)){
							$inc = ($inc == 4) ? 1 : $inc+1; 
							if($inc == 1) echo "<div class='row'>"; 
							
							$status_class = ($prow['status'] == 'Inactive') ? 'panel-danger' : 'panel-success';

							?>
								<div class="col-md-3">
									<div class="card" style="width: 18rem;">
										<img src="<?php if(empty($prow['photo'])){echo "upload/noimage.jpg";} else{echo $prow['photo'];} ?>" class="card-img-top">
										<div class="card-body">
											<div class="card-title text-center">
												<b><?php echo $prow['product_name']; ?></b>
											</div>
											<p class="card-text text-center">
											RM <?php echo number_format($prow['price'], 2); ?>
											
											<!-- Display out of stock if product status is inactive-->
											<span class="badge text-bg-<?php 
											if($prow['status'] == 'Inactive'){
												echo 'danger';
											}
											?>"><?php 
											if($prow['status'] == 'Inactive'){
												echo 'Out Of Stock';
											}
											?></span>

											</p>
										</div>
									</div>
								</div>
							<?php
							if($inc == 4) echo "</div>";
						}
						if($inc == 1) echo "<div class='col-md-3'></div><div class='col-md-3'></div><div class='col-md-3'></div></div>"; 
						if($inc == 2) echo "<div class='col-md-3'></div><div class='col-md-3'></div></div>"; 
						if($inc == 3) echo "<div class='col-md-3'></div></div>"; 
					?>
		    	</div>
			<?php

			// Get the total number of category
            $tquery="SELECT * FROM category ORDER BY category_id ASC";
            $tresult = mysqli_query($con,$tquery);
			$tnum=$tresult->num_rows-1;

            $tquery="SELECT * FROM category ORDER BY category_id ASC LIMIT 1, $tnum";
            $tresult = mysqli_query($con,$tquery);

			while($trow= mysqli_fetch_assoc($tresult)){
				?>
				<div id="<?php echo $trow['category_name']; ?>" class="tab-pane fade" style="margin-top:20px;" role="tabpanel">
					<?php
						// Displaying product for the other category
                        $pquery="SELECT * FROM product WHERE category_id='".$trow['category_id']."'";
                        $presult = mysqli_query($con,$pquery);
						$inc=4;

						while($prow = mysqli_fetch_assoc($presult)){
							$inc = ($inc == 4) ? 1 : $inc+1; 
							if($inc == 1) echo "<div class='row'>"; 

							$status_class = ($prow['status'] == 'Inactive') ? 'panel-danger' : 'panel-success';
                        
							?>
							<div class="col-md-3">
									<div class="card" style="width: 18rem;">
										<img src="<?php if(empty($prow['photo'])){echo "upload/noimage.jpg";} else{echo $prow['photo'];} ?>" class="card-img-top">
										<div class="card-body">
											<div class="card-title text-center">
												<b><?php echo $prow['product_name']; ?></b>
											</div>
											<p class="card-text text-center">
											RM <?php echo number_format($prow['price'], 2); ?>
											<span class="badge text-bg-<?php 
											if($prow['status'] == 'Inactive'){
												echo 'danger';
											}
											?>"><?php 
											if($prow['status'] == 'Inactive'){
												echo 'Out Of Stock';
											}
											?></span>											
											</p>
										</div>
									</div>
								</div>
							<?php
							if($inc == 4) echo "</div>";
						}
						if($inc == 1) echo "<div class='col-md-3'></div><div class='col-md-3'></div><div class='col-md-3'></div></div>"; 
						if($inc == 2) echo "<div class='col-md-3'></div><div class='col-md-3'></div></div>"; 
						if($inc == 3) echo "<div class='col-md-3'></div></div>"; 
					?>
		    	</div>
				<?php
			}
		?>
	</div>
</div>
<?php include('footer.php'); ?>

</body>
</html>
<?php
include("auth.php");
require('database.php');
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Dashboard - Secured Page for Admin Only</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .form-container {
            margin-top: 50px;
        }

        .admin-message {
            font-size: 24px;
            font-weight: bold;
            text-align: center;
            margin-bottom: 20px;
        }

        .dashboard-links li {
            margin-bottom: 10px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="form-container">
            <div class="jumbotron">
                <h1 class="display-4">Admin Dashboard</h1>
                <hr class="my-4">
                <?php
                //to alert he or she is log in as admin
                if (isset($_SESSION['username'])) {
                    echo "<div class='alert alert-danger' role='alert'>
                    Please take note !!! You are now logged in as ADMIN !!! 
                </div>";
                } else {
                    echo "<div class='alert alert-danger' role='alert'>
                            You are not authorized to view this page. Please login as an admin.
                        </div>";
                }
                ?>
                <div class="text-center"> 
                    <ul class="list-unstyled">
                        <!--admin action-->
                        <li><a href="catalog.php" class="btn btn-primary btn-lg mb-3">Home</a></li>
                        <li><a href="register.php" class="btn btn-primary btn-lg mb-3">Add New Admin</a></li>
                        <li><a href="product.php" class="btn btn-primary btn-lg mb-3">View Product</a></li>
                        <li><a href="view_payment.php" class="btn btn-primary btn-lg mb-3">View Payment</a></li>
                        <li><a href="manage_order.php" class="btn btn-primary btn-lg mb-3">Manage Order</a></li>
                        <li><a href="logout.php" class="btn btn-danger btn-lg">Logout</a></li>
                    </ul>
                </div> 
        </div>
    </div>

  
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <?php include('footer.php'); ?>

</body>

</html>



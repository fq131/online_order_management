<?php include('header.php'); ?>
<?php include("auth.php");?>
<?php require('database.php'); ?>
<style>
    
    .main-content {
        padding: 20px;
    }
    .wrapper {
        margin: 0 auto;
        max-width: 1200px;
    }
    h1 {
        font-size: 36px;
        margin-bottom: 20px;
    }
    
    
    .tb1-full {
        width: 100%;
        border-collapse: collapse;
    }
    .tb1-full th, .tb1-full td {
        padding: 12px;
        border: 1px solid #dddddd;
        text-align: left;
    }
    .tb1-full th {
        background-color: #f2f2f2;
        font-weight: bold;
    }
    .tb1-full td {
        background-color: #ffffff;
    }
    .tb1-full td:nth-child(even) {
        background-color: #f9f9f9;
    }
    @media (max-width: 768px) {
        .tb1-full {
            display: block;
            overflow-x: auto;
            white-space: nowrap;
        }
        .tb1-full th, .tb1-full td {
            display: block;
            width: auto;
        }
    }

    
    .btn-secondary {
        background-color: #4CAF50;
        color: white;
        padding: 8px 16px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }
    .btn-secondary:hover {
        background-color: #45a049;
    }
</style>

<!-- order details table-->
<div class="main-content">
    <div class="wrapper">
        <h1>Manage Order</h1>

        <br /><br />
        <a class="btn btn-primary" href="admin_dashboard.php">Back</a>
        <br /><br />

        <table class="tb1-full">
            <tr>
                <th>Order Id</th>
                <th>Product</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Total</th>
                <th>Order Date</th>
                <th>Status</th>
                <th>Customer Name</th>
                <th>Contact</th>
                <th>Email</th>
                <th>Address</th>
                <th>Actions</th>
            </tr>

            <?php

                $query1 = "SELECT * FROM `order`";
                $res1 = mysqli_query($con, $query1);
                $count = mysqli_num_rows($res1);
                $status = "Ordered";
                $query1 = "SELECT  FROM `order`";

                if($count > 0)
                {
                    while($row = mysqli_fetch_assoc($res1))
                    {
                        if ('qty' != 0) { 
                            $order_id = $row['order_id'];
                            $product_name = $row['product_name'];
                            $price = $row['price'];
                            $total = $row['total'];
                            $qty = $row['qty'];
                            $order_date = $row['order_date'];
                            $status = empty($row['status']) ? "Ordered" : $row['status'];
                            $customer_name = $row['customer_name'];
                            $customer_contact = $row['customer_contact'];
                            $customer_email = $row['customer_email'];
                            $customer_address = $row['customer_address'];

                            echo "<tr>";
                            echo "<td>$order_id</td>";
                            echo "<td>$product_name</td>";
                            echo "<td>$price</td>";
                            echo "<td>$qty</td>";
                            echo "<td>$total</td>";
                            echo "<td>$order_date</td>";
                            echo "<td>$status</td>";
                            echo "<td>$customer_name</td>";
                            echo "<td>$customer_contact</td>";
                            echo "<td>$customer_email</td>";
                            echo "<td>$customer_address</td>";
                            echo "<td><a href='update_order.php?order_id=$order_id' class='btn-secondary'>Update</a></td>";
                            echo "</tr>";
                        }
                    }
                }
                else
                {
                    echo "<tr><td colspan='12' class='error'>Orders not Available</td></tr>";
                }
            ?>
        </table>
    </div>
</div>
<?php include('footer.php'); ?>

<!-- end of order details table -->

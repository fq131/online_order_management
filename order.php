<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Confirm</title>
    <?php include ('header.php'); ?>
    <?php require ('database.php'); ?>

</head>

<body>
    <style>
        .form {
            padding: 20px;
        }

        @media (min-width: 576px) {
            .form {
                max-width: 500px;
                margin: 0 auto;
            }
        }

        @media (min-width: 768px) {
            .form {
                max-width: 700px;
            }
        }

        @media (min-width: 992px) {
            .form {
                max-width: 900px;
            }
        }
    </style>


    <?php
    if (isset($_POST['submit'])) {
        //$qty = mysqli_real_escape_string($con, $_POST['qty']);
        $order_date = date("Y-m-d H:i:s");
        $customer_name = mysqli_real_escape_string($con, $_POST['name']);
        $customer_contact = mysqli_real_escape_string($con, $_POST['contact']);
        $customer_email = mysqli_real_escape_string($con, $_POST['email']);
        $customer_address = mysqli_real_escape_string($con, $_POST['address']);


        // Read product details from the product table
        $query1 = "SELECT * FROM product WHERE  status='Active' ORDER BY product_id DESC";
        $result1 = mysqli_query($con, $query1);
        
        foreach ($_POST['qty'] as $productId => $qty) {
            // Check if quantity is greater than 0
            if ($qty > 0) {
                $query1 = "SELECT * FROM product WHERE product_id = $productId AND status='Active'";
                $result1 = mysqli_query($con, $query1);
                $row = mysqli_fetch_assoc($result1);
                if ($row) {
                    $photo = $row['photo'];
                    $product_name = $row['product_name'];
                    $price = $row['price'];
                    $total = $price * $qty;
    
                    $query2 = "INSERT INTO `order` (photo, product_name, price, qty, total, order_date, customer_name, customer_contact, customer_email, customer_address)
                            VALUES ('$photo', '$product_name', '$price','$qty', '$total', '$order_date', '$customer_name', '$customer_contact', '$customer_email', '$customer_address')";
    
                    $result2 = mysqli_query($con, $query2);
    
                    if ($result2) {
                        // Retrieve the last inserted order ID
                        $order_id = mysqli_insert_id($con);
                        $_SESSION['order'] = "<div class='success'>Product Ordered Successfully.</div>";
                        // Store the order ID in a session variable
                        $_SESSION['order_id'] = $order_id;

                    } else {
                        $_SESSION['order'] = "<div class='error'>Failed to order.<br/>Click here to <a href='order.php'>Order</a></div>";
                    }
                }
            }
        }

        // Redirect to make_payment.php with the order ID
        header("Location: make_payment.php?order_id=$order_id");
        //exit(); // Ensure no further code execution after redirection
    }
    ?>

    <!-- active product details table -->
    <div class="form">
        <h1>Order Confirmation Details</h1>
        <form name="order" action="" method="post">
            <div class="table-responsive">
                <table class="table">
                    <thead class="table-dark">
                        <tr>
                            <th>Product</th>
                            <th>Name</th>
                            <th>Price</th>
                            <th>Quantity</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $count = 1;
                        $query1 = "SELECT * FROM product WHERE  status='Active' ORDER BY product_id DESC";
                        $result1 = mysqli_query($con, $query1);
                        $currencySymbol = "RM";
                        while ($row = mysqli_fetch_assoc($result1)) {
                            ?>
                            <tr>
                                <td>
                                    <?php if (empty($row['photo'])): ?>
                                        <div class='alert alert-danger'>Image Not Available.</div>
                                    <?php else: ?>
                                        <a href="<?php if (empty($row['photo'])) {
                                            echo "upload/noimage.jpg";
                                        } else {
                                            echo $row['photo'];
                                        } ?>"><img src="<?php if (empty($row['photo'])) {
                                             echo "upload/noimage.jpg";
                                         } else {
                                             echo $row['photo'];
                                         } ?>" height="130px" width="180px"></a>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php echo $row['product_name']; ?>
                                </td>
                                <td>
                                    <?php echo $currencySymbol . $row['price']; ?>
                                </td>
                                <td>
                                    <label for="qty_<?php echo $row['product_id']; ?>"
                                        class="form-label visually-hidden">Quantity</label>
                                    <input type="number" id="qty_<?php echo $row['product_id']; ?>"
                                        name="qty[<?php echo $row['product_id']; ?>]" class="form-control"
                                        style="width: 70px;" required>
                                </td>
                            </tr>
                            <?php $count++;
                        } ?>
                    </tbody>
                </table>
            </div>
            <!-- end of active product details table -->
            <!-- customer details form -->
            <fieldset>
                <legend>Delivery Details</legend>
                <div class="order-">
                    <label for="name" class="form-label">Full Name</label>
                    <input type="text" id="name" name="name" placeholder="E.g. Alicia Lee" class="form-control"
                        required>
                </div>
                <div class="mb-3">
                    <label for="contact" class="form-label">Phone Number</label>
                    <input type="tel" id="contact" name="contact" placeholder="E.g. 012-xxx xxxx" class="form-control"
                        required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" id="email" name="email" placeholder="E.g. hh@gmail.com" class="form-control"
                        required>
                </div>
                <div class="mb-3">
                    <label for="address" class="form-label">Address</label>
                    <textarea id="address" name="address" rows="5" placeholder="E.g. Street, PostCode, City, Country"
                        class="form-control" required></textarea>
                </div>
                <button type="submit" name="submit" class="btn btn-primary">Confirm Order</button>
            </fieldset>
            <!-- end of customer details form -->
        </form>
    </div>
    <?php include('footer.php'); ?>

</body>

</html>
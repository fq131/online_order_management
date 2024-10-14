<?php 
include('header.php');
require('database.php');

// Check if order_id is set
if(isset($_GET['order_id'])) {
    $order_id = $_GET['order_id'];
    // get order id from order table
    $query1 = "SELECT * FROM `order` WHERE order_id=$order_id"; 
    $result1 = mysqli_query($con, $query1);
    $count = mysqli_num_rows($result1);

    if($count == 1) {
        $row = mysqli_fetch_assoc($result1);
        $product_name = $row['product_name'];
        $status = $row['status'];
        $customer_name = $row['customer_name'];
    }
}
?>

<style>

.main-content {
    width: 80%;
    margin: 0 auto;
}


.wrapper {
    padding: 20px;
    background-color: #f9f9f9;
    border-radius: 5px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}


form {
    margin-bottom: 20px;
}


table {
    width: 100%;
}

table td {
    padding: 10px;
}

input[type="text"],
select {
    width: 100%;
    padding: 8px;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
    margin-top: 5px;
}

input[type="submit"] {
    background-color: #007bff;;
    color: white;
    padding: 10px 20px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

input[type="submit"]:hover {
    background-color: #0056b3;
}

</style>

<!-- update order status form -->
<div class="main-content">
    <div class="wrapper">
        <h1>Update Order</h1>
        <br><br>
        <form action="" method="POST">
            <input type="hidden" name="order_id" value="<?php echo $order_id; ?>"> 
            <table>
                <tr>
                    <td>Product Name</td>
                    <td><?php echo $product_name; ?></td> 
                </tr>
                <tr>
                    <td>Status</td>
                    <td>
                        <select name="status">
                            <option <?php if($status=="Ordered"){echo "selected";} ?> value="Ordered">Ordered</option>
                            <option <?php if($status=="On Delivery"){echo "selected";} ?> value="On Delivery">On Delivery</option>
                            <option <?php if($status=="Delivered"){echo "selected";} ?> value="Delivered">Delivered</option>
                            <option <?php if($status=="Cancelled"){echo "selected";} ?> value="Cancelled">Cancelled</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Customer Name: </td>
                    <td>
                        <input type="text" name="customer_name" value="<?php echo $customer_name; ?>">
                    </td>
                </tr>
            </table>
            <input type="submit" value="Submit">
        </form>
        <?php
        // check if form is submitted
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $order_id = $_POST['order_id'];
            $status = $_POST['status'];
            $customer_name = $_POST['customer_name'];
            
            // update the order
            $query2 = "UPDATE `order` SET status = '$status' WHERE order_id=$order_id"; 
            $result2 = mysqli_query($con, $query2);
            if($result2) { 
                echo "<div class='success'>Order Updated.</div>"; 
                header("Location: manage_order.php");
                exit(); 
            } else {
                echo "<div class='error'>Update Failed.</div>";
            }
        }
        ?>
    </div>
</div>
<!-- end of upate status form -->

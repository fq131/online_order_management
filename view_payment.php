<?php
include("auth.php");
require ('database.php');

// Check if the delete button is clicked
if (isset($_POST['delete_payment'])) {
    // Get the payment ID of the record to delete
    $payment_id = $_POST['payment_id'];

    // Delete the payment record from the database
    $delete_query = "DELETE FROM payment WHERE payment_id = $payment_id";
    mysqli_query($con, $delete_query) or die(mysqli_error($con));
}

// Fetch payment records from the database
$sel_query = "SELECT * FROM payment ORDER BY payment_id";
$result = mysqli_query($con, $sel_query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <title>View Payment</title>

    
    <?php include ('header.php'); ?>

    <!-- <link rel="stylesheet" href="css/style3.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500&display=swap" rel="stylesheet"> -->
</head>

<style>
    .table-responsive-sm {
        padding: 30px;
    }

    .table-header th {
    color: white !important;
    background-color: black !important;
}

    .delete_btn {
        border: none;
        background-color: transparent;
    }
</style>

<body>


    <class class="welcome">
        <h2 style="text-align:center; font-family: 'Times New Roman', serif; padding-top:30px;">
            <strong>Payment History</strong>
        </h2>
    </class>

	<a class="btn btn-primary" style="margin-left: 3em;" href="admin_dashboard.php">Back</a>

    <!-- Table -->
    <div class="table-responsive-sm">
        <table class="table table-hover table-striped">
            <thead style="color : black; background-color: cornflowerblue;" class="table-header">
                <tr>
                    <th class="text-center">Payment ID</th>
                    <th class="text-center">Name</th>
                    <th class="text-center">Credit Card No.</th>
                    <th class="text-center">Order ID</th>
                    <th class="text-center">Date</th>
                    <th class="text-center">Amount Paid</th>

                    <th class="text-center"> </th>

                </tr>
            </thead>
            <tbody>
                <?php
                $count = 1;
                $sel_query = "SELECT * FROM payment ORDER BY payment_id;";
                $result = mysqli_query($con, $sel_query);
                $currencySymbol = "RM";
                while ($row = mysqli_fetch_assoc($result)) {
                    ?>
                    <tr>
                        <td align="center">
                            <?php echo $row["payment_id"]; ?>
                        </td>
                        <td align="center">
                            <?php echo $row["name_on_card"]; ?>
                        </td>
                        <td align="center">
                            <?php echo "****" . substr($row["card_number"], -4); ?>
                        </td> <!-- Masked credit card number -->
                        <td align="center">
                            <?php echo $row["order_id"]; ?>
                        </td>
                        <td align="center">
                            <?php echo $row["payment_date"]; ?>
                        </td>
                        <td align="center">
                            <?php echo $row["amount_paid"]; ?>
                        </td>
                        <td>
                            <form method="post">
                                <input type="hidden" name="payment_id" value="<?php echo $row["payment_id"]; ?>">
                                <!-- Use an image tag for the bin icon -->
                                <button class="delete_btn" type="submit" name="delete_payment"
                                    onclick="return confirm('Are you sure you want to delete this payment record?')">
                                    <img src="image/bin.png" alt="Delete" width="20" height="25">
                                </button>
                            </form>
                        </td>
                    </tr>
                    <?php $count++;
                } ?>

            </tbody>
        </table>

    </div>
    <?php include('footer.php'); ?>


</body>

</html>
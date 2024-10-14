<?php
require ('database.php');

// Start PHP session
session_start();

// Set session timeout to 1 minutes
$timeout_duration = 180; // 1 minutes
$_SESSION['last_timestamp'] = time();
// Set the last timestamp only if it's not already set (i.e., when the session starts)
if (!isset($_SESSION['last_timestamp'])) {
    $_SESSION['last_timestamp'] = time();
}

// Check session timeout
if ((time()-$_SESSION['last_timestamp']) > $timeout_duration) {
    // Redirect to order.php if session timeout occurs
    session_unset();
    session_destroy();
    // Output JavaScript alert
    echo '<script>alert("Your session has timed out. You will be redirected to order page.");';
    echo 'window.location.href = "order.php";</script>'; //chg to order.php
    exit();
}


//$payment_status = "Pending";
$status = "";

// Check if the order ID parameter exists in the URL
if(isset($_GET['order_id'])) {
    // Retrieve the order ID from the URL parameter
    $order_id = $_GET['order_id'];
    
} else {
    // Redirect the user or show an error message if the order ID parameter is missing
    // For example:
    header("Location: order.php"); // Redirect to the order page
    exit();
}

if (isset ($_POST['submit'])) {

    // Retrieve form data
    $name_on_card = $_REQUEST['name_on_card'];
    $card_number = $_REQUEST['card_number'];
    //$payment_status = "Successful"; // Default payment status
    $payment_date = date("Y-m-d H:i:s");
    
    //$order_id = $_GET['order_id'];//set explicitly for now
    $order_query = "SELECT total FROM `order` WHERE order_id = $order_id";
    $order_result = mysqli_query($con, $order_query);
    $order_row = mysqli_fetch_assoc($order_result);
    $amount_paid = $order_row['total'];

    // Insert payment record into the databases
    $ins_query = "INSERT INTO payment
                  (name_on_card, card_number, payment_date, amount_paid, order_id)
                  VALUES
                  ('$name_on_card', '$card_number', '$payment_date', '$amount_paid', '$order_id')";

    // Execute the query
    mysqli_query($con, $ins_query) or die (mysqli_error($con));

    // Redirect to payment_submitted.php after form submission
    header("Location: payment_submitted.php");
    exit(); // Ensure no further code execution after redirection
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="refresh" content="180">
    <title>Payment Form</title>
    <!-- Add Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Add Google Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: azure;
        }

        .outer-box {
            border: 2px solid black;
            padding: 20px;
            margin: 100px;
            background-color: white;
        }

        .form-control {
            border: 1px solid gray;
        }

        .short-btn {
            width: 20%;
            margin: auto;
        }

        .card-logo {
            width: 90px;
            height: auto;
        }
    </style>
</head>

<body>
    <div class="outer-box">
        <div class="outer-container">
            <div class="container mt-5">
                <h1 class="text-center">Confirm Your Payment</h1>
                <form name="form" method="post" action="">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="owner">Name on Card</label>
                                <input type="text" class="form-control" id="owner" name="name_on_card" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="cvv">CVV</label>
                                <input type="password" class="form-control" id="cvv" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="cardNumber">Card Number</label>
                                <input type="text" class="form-control" id="cardNumber" name="card_number" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="months">Expiration Month</label>
                                <select class="form-control" id="months">
                                    <option value="Jan">Jan</option>
                                    <option value="Feb">Feb</option>
                                    <option value="Mar">Mar</option>
                                    <option value="Apr">Apr</option>
                                    <option value="May">May</option>
                                    <option value="Jun">Jun</option>
                                    <option value="Jul">Jul</option>
                                    <option value="Aug">Aug</option>
                                    <option value="Sep">Sep</option>
                                    <option value="Oct">Oct</option>
                                    <option value="Nov">Nov</option>
                                    <option value="Dec">Dec</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="expirationYear">Expiration Year</label>
                                <input type="text" class="form-control" id="expirationYear" placeholder="YYYY" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="acceptedCard">Accepted Card</label>
                        <div>
                            <img src="image/mc.png" alt="Mastercard" class="card-logo mr-2">
                            <img src="image/vi.png" alt="Visa" class="card-logo mr-2">
                            <img src="image/pp.png" alt="PayPal" class="card-logo">
                        </div>
                    </div>
                    <p style="color:#008000;">
                        <?php echo $status; ?>
                    </p>
                    <div class="text-center">
                        <p id="sessionTimer" style="font-size: 20px;"></p>
                    </div>
                    <button name="submit" id="submitBtn" type="submit" class="btn btn-primary btn-block short-btn">Confirm</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>

        // Display the countdown timer to alert user about the time left 
        var duration = <?php echo $timeout_duration; ?>; // Timeout duration in seconds
        var timer = setInterval(function() {
            duration--;
            var minutes = Math.floor(duration / 60);
            var seconds = duration % 60;
            document.getElementById('sessionTimer').innerText = 'Session Timeout in: ' + minutes + ' mins ' + seconds + 'seconds';

        }, 1000); // Update timer every second
    </script>
</body>

</html>
<?php
require ('database.php');
?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <title>Payment Complete</title>

    <!-- Custom CSS for loader -->
    <style>
        /* Style for countdown text */
        #countdown {
            font-size: 24px;
            text-align: center;
            margin-top: 10px;
            /* Adjusted margin */
            margin-left: 10px;
            color: #3498db;
            /* Blue color */
        }

        .checked-img {
            height: 150px;
            width: auto;
            margin-top: 50px;
            margin-bottom: 10px;
            display: block;

        }

        .wrapper {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100vh;
            /* Set the wrapper height to full viewport height */
            line-height: 1.8;
        }
    </style>
</head>

<body>
    <div class="wrapper">
        <!-- Image -->
        <img class="checked-img" src="image/checked.png" alt="checked img">

        <!-- Content -->
        <div class="container mt-5 text-center">
            <div class="text-success fw-bold" style="font-size: 36px"> Your payment has been confirmed! </div>
            <div class="fs-4 text-secondary">
                Thanks for purchasing from us! <br>
                You will now be directed to the catalog page.
                <div id="countdown">Redirecting in 5 seconds...</div>
            </div>
        </div>

        <!-- JavaScript to redirect to main menu after 5 seconds -->
        <script>
        var countdown = 5; // Initial countdown value in seconds

        function updateCountdown() {
            document.getElementById('countdown').innerHTML = 'Redirecting in ' + countdown + ' seconds...';
            countdown--;
            if (countdown >= 0) {
                setTimeout(updateCountdown, 1000); // Update countdown every second
            } else {
                window.location.href = "catalog.php"; // Redirect when countdown reaches 0
            }
        }

        // Start the countdown
        updateCountdown();
    </script>
    </div>
</body>

</html>
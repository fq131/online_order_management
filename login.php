<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Login</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .form-container {
            margin-top: 50px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 form-container">
                <div class="card">
                    <div class="card-header">
                        <h3 class="text-center">User Log In</h3>
                    </div>
                    <div class="card-body">
                        <?php
                        require('database.php');
                        if (isset($_POST['username'])) {
                            $username = stripslashes($_REQUEST['username']);
                            $username = mysqli_real_escape_string($con, $username);
                            $password = stripslashes($_REQUEST['password']);
                            $password = mysqli_real_escape_string($con, $password);

                            //SQL
                            $query = "SELECT * FROM `user` WHERE name='$username' AND password='" . md5($password) . "'";
                            $result = mysqli_query($con, $query) or die(mysqli_error($con));
                            $rows = mysqli_num_rows($result);
                            if ($rows == 1) {
                                $_SESSION['username'] = $username;
                                //once login redirect to dashboard

                                header("Location: admin_dashboard.php");
                                exit();
                            } else {
                                //wrong username or password
                                echo "<div class='alert alert-danger' role='alert'>
                                        Username/password is incorrect. Please try again.
                                    </div>";
                            }
                        }
                        ?>
                        <form action="" method="post" name="login">
                            <div class="form-group">
                                <label for="username">Username</label>
                                <input type="text" class="form-control" id="username" name="username" placeholder="Enter username" required>
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" id="password" name="password" placeholder="Enter password" required>
                            </div>
                            <button name="submit" type="submit" class="btn btn-primary btn-block">Login</button>
                        </form>
                        <p class="mt-3">Not registered yet? Contact IT support to create your admin account via email now!</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>

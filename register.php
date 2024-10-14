<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration</title>
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
    <?php
    require ('database.php');
    if (isset ($_REQUEST['username'])) {
        $username = stripslashes($_REQUEST['username']);
        $username = mysqli_real_escape_string($con, $username);
        $password = stripslashes($_REQUEST['password']);
        $password = mysqli_real_escape_string($con, $password);
        $id = stripslashes($_REQUEST['staffID']);
        $id = mysqli_real_escape_string($con, $id);

        //SQL
        $query = "INSERT into `user` (name, password, staffNo) VALUES ('$username', '" . md5($password) . "', '$id')";
        $result = mysqli_query($con, $query);
        if ($result) {
            echo "<div class='form'> <h3>You are registered successfully.</h3><br/>Click here to <a href='login.php'>Login</a></div>";
        }
    } else {
        ?>
         <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 form-container">
                <div class="card">
                    <div class="card-header">
                        <h3 class="text-center">User Registration</h3>
                    </div>
                    <div class="card-body">
                        <form name="registration" action="" method="post">
                            <div class="form-group">
                                <label for="username">Username</label>
                                <input type="text" class="form-control" id="username" name="username" placeholder="Enter username" required>
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" id="password" name="password" placeholder="Enter password" required>
                            </div>
                            <div class="form-group">
                                <label for="staffID">Staff Number</label>
                                <input type="text" class="form-control" id="staffID" name="staffID" placeholder="Enter staff number" required>
                            </div>
                            <button type="submit" name="submit" class="btn btn-primary btn-block">Register</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php } ?>
 
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>


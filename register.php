<!--Database_config-->
<?php


$server = "localhost";
$username = "root";
$password = "";
$database = "users8617";

$conn = mysqli_connect($server, $username, $password, $database);

if (!$conn) {

    die("error" . mysqli_connect_error());
}

?>

<!--Getting info from input field-->
<?php
$successAlert = false;
$errorAlert = false;
$regx = "/^[a-zA-Z\s\d]+$/";
$regxb = '#[a-zA-Z\d]*[A-Z][a-zA-Z\d]*#';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $uname = $_POST['uname'];
    $pswd = $_POST['pswd'];
    // $pswd = 32423432;
    $cpassword = $_POST['cpass'];
    // $cpassword = 32423432;


    if (preg_match_all($regx, $uname)) {
        // echo $uname, $pswd, $cpassword;
        if (preg_match_all($regxb, $pswd))
        {
            $existsql = "Select * from users where name='$uname'";
            $result = mysqli_query($conn, $existsql);
            $existrows = mysqli_num_rows($result);
            if ($existrows > 0) {
                $errorAlert = "User Already Exists";
            } else {
                if ($pswd == $cpassword) {
                    $sql = "INSERT INTO `users` (`name`, `password`, `dt`) VALUES ( '$uname', '$pswd', current_timestamp())";;
                    $result = mysqli_query($conn, $sql);
                    if ($result) {
                        $successAlert = true;
                    }
                } else {
                    $errorAlert = "Password did not match";
                }
            }
        } else {
            $errorAlert = "Password Requirements did not match";
        }
    } else {
        $errorAlert = "Only strings,numbers and whitespaces are allowed in username";
    }
}

?>


<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Signup</title>
</head>

<body>
    <!-- navbar -->
    <?php require "_nav.php" ?>
    <!-- alerts -->
    <?php

    if ($successAlert == true) {
        echo
        '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success!</strong> Your account is created and now you can login.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
    }
    if ($errorAlert == true)
        echo
        '<div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Error!</strong> ' . $errorAlert . '.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>'
    ?>

    <!-- input fields -->
    <div class="container my-5">
        <h1 class="text-center">Register to our website !! </h1>
        <form method="post" action="register.php">
            <div class="mb-3">
                <label for="uname" class="form-label">Username</label>
                <input type="text" class="form-control" name="uname" aria-describedby="emailHelp">

            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" placeholder="Password should contain at least 1-lowercase, 1-uppercase, 1-special Character and password length must be eight or greater. " name="pswd" id="password">
            </div>
            <div class="mb-3">
                <label for="cpassword" class="form-label">Confirm Password</label>
                <input type="password" class="form-control" placeholder="Password should contain at least 1-lowercase, 1-uppercase, 1-special Character and password length must be eight or greater. " name="cpass" id="cpassword">
                <div id="emailHelp" class="form-text">Password should be same.</div>
            </div>
            <button type="submit" class="btn btn-primary">Sign up</button>
        </form>
    </div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

</body>

</html>
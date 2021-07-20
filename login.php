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
$login = false;
$errorAlert=false;
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $uname = $_POST['uname'];
    $pswd = $_POST['pswd'];
    // $pswd = 32423432;
  

    // echo $uname, $pswd, $cpassword;
    
        $sql = "Select * from users where name='$uname' AND password='$pswd'";
        $result = mysqli_query($conn, $sql);
        $num=mysqli_num_rows($result);
        if ($num==1) {
            $login = true;
            session_start();
            $_SESSION['loggedin']=true;
            $_SESSION['username']=$uname;
            header("location: welcome.php"); 
        }
        else if($num!=1){
            $errorAlert = "Invalid Username or Password";
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

    <title>Login</title>
</head>

<body>
    <!-- navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="/Validation">iSecure</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="/Validation">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/Validation/login.php">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/Validation/register.php">Signup</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/Validation/login.php">Logout</a>
                    </li>

                </ul>
                <form class="d-flex">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
            </div>
        </div>
    </nav>
    <!-- alerts -->
    <?php

    if ($login == true) {
        echo
        '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success!</strong> You are logged in.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
    }
    if ($errorAlert==true)
        echo
        '<div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Error!</strong> '.$errorAlert.'
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>'
    ?>

    <!-- input fields -->
    <div class="container my-5">
        <h1 class="text-center">Login to our website !! </h1>
        <form method="post" action="login.php">
            <div class="mb-3">
                <label for="uname" class="form-label">Username</label>
                <input type="text" class="form-control" name="uname" aria-describedby="emailHelp">

            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" name="pswd" id="password">
            </div>
            <button type="submit" class="btn btn-primary">Login</button>
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
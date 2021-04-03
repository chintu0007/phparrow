<?php
include("app/Classes/User.php");

if (isset($_POST['loginame']) && !empty($_POST['loginame']) && isset($_REQUEST['password'])) {
    $loginame = $_POST['loginame'];
    $password = $_POST['password'];

    $user = new User;
    $checklogin = $user->loginUser($loginame, $password);
    if ($checklogin == true) {
        $url = "/dashboard.php";
        $user->redirect($url);
    }
}


?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>Login</title>
</head>

<body>
    <?php
    $codes = ['#ff4000', '#00bfff', '#bf00ff', '#ff00bf', '#ff0040', '#bfff00'];
    $k = array_rand($codes);
    $v = $codes[$k];

    ?>

    <div class="container">
        <div class="row">
            <div class="col">
                <div style="background-color:<?php echo $v; ?>;height: 140px;
    margin-bottom: 15px;">
                    <div style="color: white;
    font-weight: bold;
    text-align: center;
    padding-top: 60px;">Login</div>
                </div>
            </div>
        </div>
    </div>


    <div class="container">

        <div class="row">
            <div class="col-sm">
                &nbsp;
            </div>
            <div class="col-sm">
                <?php if (isset($_GET['_success'])) { ?>
                    <div class="alert alert-success" role="alert">
                        Registration successful, login with new username and password
                    </div>
                <?php }  ?>
            </div>
            <div class="col-sm">
                &nbsp;
            </div>

        </div>


        <div class="row">
            <div class="col-sm">
                &nbsp;
            </div>
            <div class="col-sm">
                <form method="post" id="loginform" action="login.php">
                    <!--div class="form-group">
                        <label for="exampleInputEmail1">Email address</label>
                        <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
                        <small id="emailHelp"  class="form-text text-muted">We'll never share your email with anyone else.</small>
                    </div-->
                    <div class="form-group">
                        <label for="exampleInputEmail1">Login Name</label>
                        <input type="text" name="loginame" class="form-control" id="loginame" aria-describedby="loginNameHelp" placeholder="Enter login name">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Password</label>
                        <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                    </div>
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="exampleCheck1">
                        <label class="form-check-label" for="exampleCheck1">Check me out</label>
                    </div>
                    <button type="submit" class="btn btn-primary" value="loginsubmit">Submit</button>

                    <div class="etc-login-form">
                        <!-- <p>forgot your password? <a href="#">click here</a></p> -->
                        <p>new user? <a href="/register.php">create new account</a></p>
                    </div>

                </form>
            </div>
            <div class="col-sm">
                &nbsp;
            </div>
        </div>
    </div>


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>

</html>
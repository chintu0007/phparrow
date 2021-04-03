<?php
include("app/Classes/User.php");


if (isset($_POST['submitsingin'])) {
    $user = new User;
    $register = $user->registerUser($_POST);
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
    <title>Register</title>
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
    padding-top: 60px;">Register</div>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">

            <div class="col">
                <div class="form-group row">
                    <?php if (isset($register) && $register != true) { ?>
                        <div class="alert alert-danger" role="alert">
                            Registration error!! something wrong with registration of user
                        </div>
                    <?php }  ?>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <form method="post" id="registerform" action="register.php">

                    <div class="form-group row">
                        <label for="inputFullName3" class="col-sm-2 col-form-label">Full Name</label>
                        <div class="col-sm-10">
                            <input type="text" name="fullname" id="fullname" class="form-control" id="inputFullName3" placeholder="Full Name">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputLoginName3" class="col-sm-2 col-form-label">Login Name</label>
                        <div class="col-sm-10">
                            <input type="text" name="loginame" id="userloginname" class="form-control" id="inputLoginName3" placeholder="Login Name" onBlur="return checkAvailability('loginname')">
                            <span id="loginname-availability-status"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-10">
                            <input type="email" name="email" id="useremail" class="form-control" id="inputEmail3" placeholder="Email" onBlur="return checkAvailability('email')">
                            <span id="email-availability-status"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputPassword3" class="col-sm-2 col-form-label">Password</label>
                        <div class="col-sm-10">
                            <input type="password" name="password" class="form-control" id="inputPassword3" placeholder="Password">
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-sm-10">
                            <button type="submit" class="btn btn-primary">Sign in</button>
                            <input type="hidden" name="submitsingin" />
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="row">
            <div id="col">
                <div class="etc-login-link">
                    <!-- <p>forgot your password? <a href="#">click here</a></p> -->
                    <p><a href="/login.php">Login, click here</a> </p>
                </div>
            </div>
        </div>
    </div>


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"> </script>

    <script>
        function checkAvailability(checkField) {

            if (checkField == "loginname")
                var loginName = jQuery("#userloginname").val();
            else if (checkField == "email")
                var loginName = jQuery("#useremail").val();

            jQuery.ajax({
                method: "POST",
                url: "/helpers/ajax.php",
                dataType: "json",
                data: {
                    action: "loginnameavailability",
                    loginname: loginName,
                    checkfield: checkField
                }
            }).done(function(response) {

                console.log(response);

                if (response.success == true) {
                    if (response.status == 0) {

                        if (response.checkfield == "loginname") {
                            var textname = "Login Name";
                        }
                        if (response.checkfield == "email") {
                            var textname = "Email";
                        }

                        jQuery("#" + response.checkfield + "-availability-status").text(textname + " already exists. please try another");
                        jQuery("#" + response.checkfield + "-availability-status").css("color", "#ff0000");
                        //jQuery("#submitloginbutton").prop("disabled", true);

                    } else {
                        jQuery("#" + response.checkfield + "-availability-status").text("");
                        //Query("#submitloginbutton").prop("disabled", false);
                    }
                }

                return false;
                //alert( "Data Saved: " + msg );                        
                //console.log(msg);
            });

        }
    </script>

</body>

</html>
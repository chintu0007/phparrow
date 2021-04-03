<?php session_start(); ?>
<?php
include("app/Classes/User.php");

$user = new User;

if (isset($_GET['_logout'])) {
    $user->log_out();
}

$checklogin = $user->is_logged_in();
if ($checklogin == true) {
} else {
    $url = "/login.php";
    $user->redirect($url);
}

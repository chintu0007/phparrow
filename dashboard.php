<?php
include "logout.php";

$listing = $user->getUsers();

// echo "<pre>";
// print_r($listing);
// die;

?>

<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
  <title>Dashboard</title>

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
    padding-top: 60px;">
            <a style="float:right;margin:0px 10px 0px 0px;" href="<?php echo "logout.php/?_logout" ?>" class="btn btn-secondary">Logout</a>
            <h2>Welcome, <?php if (isset($_SESSION['user_session'])) : echo $_SESSION['user_session']['fullname'];
                          endif; ?></h2>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="container">
    <div class="row">
      <div class="col">

        <table id="userlisting" class="display" style="width:100%">
          <thead>
            <tr>
              <th>id</th>
              <th>Full Name</th>
              <th>Login Name</th>
              <th>Password</th>
              <th>Email</th>
              <th>Created at</th>
            </tr>
          </thead>
          <tfoot>
            <tr>
              <th>id</th>
              <th>Full Name</th>
              <th>Login Name</th>
              <th>Password</th>
              <th>Email</th>
              <th>Created at</th>
            </tr>
          </tfoot>
        </table>

      </div>
    </div>
  </div>

  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

  <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
  <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>

  <script>
    $(document).ready(function() {

      $('#userlisting').DataTable({
        "processing": true,
        "serverSide": true,
        ajax: {
          url: '/helpers/ajax.php',
          type: "POST",
          data: {
            action: 'server_processing'
          }
        }
      });
    });
  </script>

</body>

</html>
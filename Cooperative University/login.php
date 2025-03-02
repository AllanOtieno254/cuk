<?php
session_start();
include_once 'database.php';
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Cooperative University-Login</title>
  <link rel="icon" href="../img/favicon2.png">
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="plugins/iCheck/square/blue.css">
  <!-- Custom styles -->
  <style>
  .body {
    background-image: url('coop.jpeg'); /* Corrected the image path */
    background-size: cover;
    background-repeat: no-repeat;
    background-attachment: fixed;
    height: 100vh; /* Set height to 100% of viewport height */
  }
</style>

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<div class="body">
<body class="hold-transition login-page bg-green">
<div class="login-box">
  <div class="login-logo">
    <a href="../"><b>Cooperative University</b>  Login</a><br>
    <small style="text-align: center;font-size:50% !important"><b>School management System</b></small>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Sign in to start your session</p>

    <form method="post">
      <div class="form-group has-feedback">
        <input name="email" type="email" class="form-control" placeholder="Email">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input name="password" type="password" class="form-control" placeholder="Password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-12">
          <button name="submit" value="submit" type="submit" class="btn btn-success btn-block btn-flat">Sign In</button>
        </div>
      </div>
    </form>

    <?php
    if (isset($_POST['submit'])) {
      $email = $_POST['email'];
      $password = $_POST['password'];
      $sql = "SELECT * FROM user WHERE email ='".$email."' and password = '".$password."' ";
      $result = $conn->query($sql);
      if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
          $_SESSION['role'] = $row['role'];
        }
        $sql2 = "SELECT * FROM ".$_SESSION['role']." WHERE email ='".$email."'";
        $result2 = $conn->query($sql2);
        if ($result2->num_rows > 0) {
          while($row2 = $result2->fetch_assoc()) {
            $_SESSION['user'] = $row2['fname']." ".$row2['lname'];
            if($_SESSION['role']=='Student'){
              $_SESSION['uid']=$row2['sid'];
            }else if($_SESSION['role']=='Parent'){
              $_SESSION['uid']=$row2['pid'];
            }else if($_SESSION['role']=='Teacher'){
              $_SESSION['uid']=$row2['tid'];
            }
          }
        }
        header("Location:./");
      }else{
        echo "<p style='width:100%;text-align:center'>Incorrect username or password</p>";
      }
    }
    ?>

  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->
</div>

<!-- jQuery 3 -->
<script src="bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="plugins/iCheck/icheck.min.js"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' /* optional */
    });
  });
</script>
</body>
</html>

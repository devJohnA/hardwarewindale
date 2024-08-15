<?php

require_once("../include/initialize.php");



 ?>

<?php

 // login confirmation

  if(isset($_SESSION['USERID'])){

    redirect(web_root."admin/index.php");

  }

  ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.min.css">
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
            <style>.login-dark {
                height: 1000px;
                background-size: cover;
                position: relative;
              }
              
              .login-dark form {
                max-width: 320px;
                width: 90%;
                background-color: white;
                padding: 40px;
                border-radius: 4px;
                transform: translate(-50%, -50%);
                position: absolute;
                top: 50%;
                left: 50%;
                color: black;
                box-shadow: 3px 3px 4px rgba(0,0,0,0.2);
              }
              
              .login-dark .illustration {
                text-align: center;
                padding: 15px 0 20px;
                font-size: 100px;
                color: #2980ef;
              }
              
              .login-dark form .form-control {
                background: none;
                border: none;
                border-bottom: 1px solid #434a52;
                border-radius: 0;
                box-shadow: none;
                outline: none;
                color: inherit;
              }
              
              .login-dark form .btn-primary {
                background: #fd2323;
                border: none;
                border-radius: 4px;
                padding: 11px;
                box-shadow: none;
                margin-top: 26px;
                text-shadow: none;
                outline: none;
              }
              
              .login-dark form .btn-primary:hover, .login-dark form .btn-primary:active {
                background: seagreen;
                outline: none;
              }
              
              .login-dark form .forgot {
                display: block;
                text-align: center;
                font-size: 12px;
                color: #6f7a85;
                opacity: 0.9;
                text-decoration: none;
              }
              
              .login-dark form .forgot:hover, .login-dark form .forgot:active {
                opacity: 1;
                text-decoration: none;
              }
              
              .login-dark form .btn-primary:active {
                transform: translateY(1px);
              }
              </style>
</head>

<body style="background:#Eb212a;;">
            <div class="login-dark" style="height: 695px;">
            <form method="post" action="" role="login">
                    <h2 class="sr-only">Login Form</h2>
                    <div class="illustration"><img src="img/wk.png" width="120" height="150"></i></div>
                    <div class="form-group"><input class="form-control" type="email" name="user_email" placeholder="Email"></div>
                    <div class="form-group"><input class="form-control" type="password" name="user_pass" id="password" placeholder="Password"></div>
                    <div class="form-group"><button type="submit" name="btnLogin" class="btn btn-primary btn-block">Log In</button></div></form>
            </div>
           
            <?php 
if(isset($_POST['btnLogin'])){
  $username = trim($_POST['user_email']);  // Note: We're still using 'user_email' for the username field
  $upass = trim($_POST['user_pass']);
  $h_upass = sha1($upass);
  
  if ($username == '' OR $upass == '') {
    echo "<script>
      Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: 'Username and Password are required!',
      })
    </script>";
  } else {  
    $user = new User();
    
    // First, check if the username exists
    if (User::checkUsernameExists($username)) {
      // If username exists, attempt authentication
      $res = User::userAuthentication($username, $h_upass);
      
      if ($res == true) { 
        echo "<script>
          Swal.fire({
            icon: 'success',
            title: 'Success!',
            text: 'You login as ".$_SESSION['U_ROLE'].".',
          }).then((result) => {
            if (result.isConfirmed) {
              window.location.href = '".($_SESSION['U_ROLE']=='Administrator' ? web_root."admin/index.php" : web_root."admin/login.php")."';
            }
          })
        </script>";
      } else {
        // Username exists but password is incorrect
        echo "<script>
  Swal.fire({
    title: 'Oops...',
    html: '<div style=\"font-size: 3em;\">😢</div><p>Invalid Password. Please try again!</p>',
  })
</script>";
      }
    } else {
      // Username doesn't exist
      echo "<script>
        Swal.fire({
          icon: 'error',
          title: 'Error',
          text: 'Account does not exist. Please check your username.',
        })
      </script>";
    }
  }
} 
?>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
</body>

</html>
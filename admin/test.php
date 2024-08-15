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
    <script src="https://kit.fontawesome.com/64d58efce2.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="style.css" />
    <title>Log in Now</title>
</head>

<body>
    <div class="container">
        <div class="forms-container">
            <div class="signin-signup">
                <form method="post" action="" role="login" class="sign-in-form">
                    <h2 class="title">Sign in</h2>
                    <div class="input-field">
                        <i class="fas fa-user"></i>
                        <input type="input" name="user_email" placeholder="Username" />
                    </div>
                    <div class="input-field">
                        <i class="fas fa-lock"></i>
                        <input type="password" name="user_pass" id="password" placeholder="Password" />
                    </div>
                    <input type="submit" name="btnLogin" value="Login" class="btn solid" />
            </div>
        </div>

        <div class="panels-container">
            <div class="panel left-panel">
                <div class="content">
                    <h3>New here ?</h3>
                    <p>
                        Lorem ipsum, dolor sit amet consectetur adipisicing elit. Debitis,
                        ex ratione. Aliquid!
                    </p>
                    <button class="btn transparent" id="sign-up-btn">
                        Sign up
                    </button>
                </div>
                <img src="img/log.svg" class="image" alt="" />
            </div>
            <div class="panel right-panel">
                <div class="content">
                    <h3>One of us ?</h3>
                    <p>
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Nostrum
                        laboriosam ad deleniti.
                    </p>
                    <button class="btn transparent" id="sign-in-btn">
                        Sign in
                    </button>
                </div>
                <img src="img/register.svg" class="image" alt="" />
            </div>
        </div>
    </div>

    <script src="app.js"></script>
    <?php 



if(isset($_POST['btnLogin'])){

  $email = trim($_POST['user_email']);

  $upass  = trim($_POST['user_pass']);

  $h_upass = sha1($upass);

  

   if ($email == '' OR $upass == '') {



      message("Invalid Username and Password!", "error");

      redirect("login.php");

         

    } else {  

  //it creates a new objects of member

    $user = new User();

    //make use of the static function, and we passed to parameters

    $res = $user::userAuthentication($email, $h_upass);

    if ($res==true) { 

       message("You login as ".$_SESSION['U_ROLE'].".","success");

      if ($_SESSION['U_ROLE']=='Administrator'){

         redirect(web_root."admin/index.php");

      }else{

           redirect(web_root."admin/login.php");

      }

    }else{

      message("Account does not exist! Please contact Administrator.", "error");

       redirect(web_root."admin/login.php"); 

    }

 }

 } 

 ?>

</body>

</html>
 <?php 
require_once "server.php"; 
$email = $_SESSION['email'];
if($email == false){
  header('Location: index.php');
}
?>
 <!DOCTYPE html>
 <html lang="en">

 <head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <meta name="description" content="">
     <meta name="author" content="">
     <title>Reset Code | Windale Hardware</title>

     <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
     <style>
     @import url('https://fonts.googleapis.com/css?family=Poppins:400,500,600,700&display=swap');

     html,
     body {
         background: #fff;
         background-size: cover;
         font-family: 'Poppins', sans-serif;
     }

     ::selection {
         color: #fff;
         background: maroon;
     }

     .container {
         position: absolute;
         top: 50%;
         left: 50%;
         transform: translate(-50%, -50%);
     }

     .container .form {
         background: #fff;
         padding: 30px 35px;
         border-radius: 5px;
         box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
     }

     .container .form form .form-control {
         height: 40px;
         font-size: 15px;
     }

     .container .form form .forget-pass {
         margin: -15px 0 15px 0;
     }

     .container .form form .forget-pass a {
         font-size: 15px;
     }

     .container .form form .button {
         background: maroon;
         color: #fff;
         font-size: 17px;
         font-weight: 500;
         transition: all 0.3s ease;
     }

     .container .form form .button:hover {
         background: #c90000;
     }

     .container .form form .link {
         padding: 5px 0;
     }

     .container .form form .link a {
         color: maroon;
     }

     .container .login-form form p {
         font-size: 14px;
     }

     .container .row .alert {
         font-size: 14px;
     }
     </style>
 </head>

 <body>
     <div class="container">
         <div class="row">
             <div class="col-md-4 offset-md-4 form">
                 <form action="reset-code.php" method="POST" autocomplete="off">
                     <h2 class="text-center">Code Verification</h2>
                     <?php 
                    if(isset($_SESSION['info'])){
                        ?>
                     <div class="alert alert-success text-center" style="padding: 0.4rem 0.4rem">
                         <?php echo $_SESSION['info']; ?>
                     </div>
                     <?php
                    }
                    ?>
                     <?php
                    if(count($errors) > 0){
                        ?>
                     <div class="alert alert-danger text-center">
                         <?php
                            foreach($errors as $showerror){
                                echo $showerror;
                            }
                            ?>
                     </div>
                     <?php
                    }
                    ?>
                     <div class="form-group">
                         <input class="form-control" type="text" name="otp" placeholder="Enter code" required>
                     </div>
                     <div class="form-group">
                         <input class="form-control button" type="submit" name="check-reset-otp" value="Submit">
                     </div>
                 </form>
             </div>
         </div>
     </div>

 </body>

 </html>
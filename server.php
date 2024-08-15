<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// require("../config.php");
require 'vendor/PHPMailer/src/Exception.php';
require 'vendor/PHPMailer/src/PHPMailer.php';
require 'vendor/PHPMailer/src/SMTP.php';
?>
<?php 
session_start();

$email = "";
$name = "";
$errors = array();


//connect to database
$con = mysqli_connect('localhost', 'root', '', 'dried');

//if user clicks register button
if(isset($_POST['register'])){
    $name = mysqli_real_escape_string($con, $_POST['name']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $password = mysqli_real_escape_string($con, $_POST['password']);
    $cpassword = mysqli_real_escape_string($con, $_POST['cpassword']);
    if($password !== $cpassword){
        $errors['password'] = "Confirm password not matched!";
    }
    $email_check = "SELECT * FROM tblcustomer WHERE EMAILADD = '$email'";
    $res = mysqli_query($con, $email_check);
    if(mysqli_num_rows($res) > 0){
        $errors['email'] = "The Email that you entered already exists!";
    }
    if(count($errors) === 0){
        $encpass = sha1($password, PASSWORD_BCRYPT);
        $code = rand(100000, 999999);
        $status = "notverified";
        $insert_data = "INSERT INTO tblcustomer (name, email, password, code, status)
                        values('$name', '$email', '$encpass', '$code', '$status')";
        $data_check = mysqli_query($con, $insert_data);
        
                    
        //if($data_check){
         //   $subject = "Email Verification Code";
         //   $message = "Your verification code is $code";
         //   $sender = "From: imarx5277@gmail.com";
         //   if(mail($email, $subject, $message, $sender)){
           //     $info = "We've sent a verification code to your email - $email";
           //     $_SESSION['info'] = $info;
          //      $_SESSION['email'] = $email;
          //      $_SESSION['password'] = $password;
           //     header('location: user-otp.php');
           //     exit();
          //  }else{
           //     $errors['otp-error'] = "Failed while sending code!";
           // }
        //}else{
        //    $errors['db-error'] = "Failed while inserting data into database!";
        //}
   }

}
    //if user clicks verification code submit button
    if(isset($_POST['check'])){
        $_SESSION['info'] = "";
        $otp_code = mysqli_real_escape_string($con, $_POST['otp']);
        $check_code = "SELECT * FROM usertable WHERE code = $otp_code";
        $code_res = mysqli_query($con, $check_code);
        if(mysqli_num_rows($code_res) > 0){
            $fetch_data = mysqli_fetch_assoc($code_res);
            $fetch_code = $fetch_data['code'];
            $email = $fetch_data['email'];
            $code = 0;
            $status = 'verified';
            $update_otp = "UPDATE usertable SET code = $code, status = '$status' WHERE code = $fetch_code";
            $update_res = mysqli_query($con, $update_otp);
            if($update_res){
                $_SESSION['name'] = $name;
                $_SESSION['email'] = $email;
                header('location: home.php');
                exit();
            }else{
                $errors['otp-error'] = "Failed while updating code!";
            }
        }else{
            $errors['otp-error'] = "You've entered incorrect code!";
        }
    }

    //if user click login button
    if(isset($_POST['login'])){
        $email = mysqli_real_escape_string($con, $_POST['email']);
        $password = mysqli_real_escape_string($con, $_POST['password']);
        $check_email = "SELECT * FROM usertable WHERE email = '$email'";
        $res = mysqli_query($con, $check_email);
        if(mysqli_num_rows($res) > 0){
            $fetch = mysqli_fetch_assoc($res);
            $fetch_pass = $fetch['password'];
            if(password_verify($password, $fetch_pass)){
                $_SESSION['email'] = $email;
                $status = $fetch['status'];
                if($status == 'verified'){
                  $_SESSION['email'] = $email;
                  $_SESSION['password'] = $password;
                    header('location: home.php');
                }else{
                    $info = "It looks like you haven't still verified your email - $email";
                    $_SESSION['info'] = $info;
                    header('location: user-otp.php');
                }
            }else{
                $errors['email'] = "Incorrect email or password!";
            }
        }else{
            $errors['email'] = "It looks like you're not yet a member! Click on the bottom link to register.";
        }
    }

    //if user click continue button in forgot password form
    if(isset($_POST['check-email'])){
        $email = mysqli_real_escape_string($con, $_POST['email']);
        $check_email = "SELECT * FROM tblcustomer WHERE EMAILADD='$email'";
        $run_sql = mysqli_query($con, $check_email);
        if(mysqli_num_rows($run_sql) > 0){
            $code = rand(100000, 999999);
            $insert_code = "UPDATE tblcustomer SET ZIPCODE = $code WHERE EMAILADD = '$email'";
            $run_query =  mysqli_query($con, $insert_code);
            if($run_query){
                $subject = "Reset Password Notification";
                $message = "<h2>windale Hardware inc.</h2>
                <p>This is your OTP code:  <b>$code</b> <br><br>
                    Please use this code to set your new password.<br><br>
                    If you didn't request this code, you can disregard this message.
                </p>
                ";
                $sender = "ilustrisimojb0@gmail.com";
                //Load composer's autoloader

$insert_data = "INSERT INTO `messagein` (`Id`, `SendTime`, `MessageFrom`, `MessageTo`, `MessageText`) VALUES ('', '', 'MPLA', '$email', 'OTP code is $code')";
        $data_check = mysqli_query($con, $insert_data);

    $mail = new PHPMailer(true);                            
    try {
        //Server settings
        $mail->isSMTP();                                     
        $mail->Host = 'smtp.gmail.com';                      
        $mail->SMTPAuth = true;                             
        $mail->Username = $sender;     
        $mail->Password = 'voywpiwadwbvijhl';             
        $mail->SMTPOptions = array(
            'ssl' => array(
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true
            )
        );                         
        $mail->SMTPSecure = 'ssl';                           
        $mail->Port = 465;                                   

        //Send Email
        $mail->setFrom('testingjohn@gmail.com', 'Online');
        
        //Recipients
        $mail->addAddress($email);              
        $mail->addReplyTo('testingjohn@gmail.com');
        
        //Content
        $mail->isHTML(true);                     

        $mail->Subject = $subject;
        $mail->Body    = $message;

        $mail->send();
		
       $_SESSION['result'] = 'Message has been sent';
	   
    } catch (Exception $e) {
	   $_SESSION['result'] = 'Message could not be sent. Mailer Error: '.$mail->ErrorInfo;
	   
    }
	
	
                if(isset($email, $subject, $message, $sender)){
                    $info = "We've sent a password reset otp to your email - $email";
                    $_SESSION['info'] = $info;
                    $_SESSION['email'] = $email;

                    header('location: reset-code.php');
                    exit();
                }else{
                    $errors['otp-error'] = "Failed while sending code!";
                }
            }else{
                $errors['db-error'] = "Something went wrong!";
            }
        }else{
            $errors['email'] = "This email address does not exist!";
        }
        
    }

    //if user click check reset otp button
    if(isset($_POST['check-reset-otp'])){
        $_SESSION['info'] = "";
        $otp_code = mysqli_real_escape_string($con, $_POST['otp']);
        $check_code = "SELECT * FROM tblcustomer WHERE ZIPCODE = $otp_code";
        $code_res = mysqli_query($con, $check_code);
        if(mysqli_num_rows($code_res) > 0){
            $fetch_data = mysqli_fetch_assoc($code_res);
            $email = $fetch_data['EMAILADD'];
            $_SESSION['EMAILADD'] = $email;
            $info = "Please create a new password.";
            $_SESSION['info'] = $info;
            header('location: new-password.php');
            exit();
        }else{
            $errors['otp-error'] = "You've entered an incorrect code!";
        }
    }

    //if user click change password button
    if(isset($_POST['change-password'])){
        $_SESSION['info'] = "";
        $password = mysqli_real_escape_string($con, $_POST['password']);
        $cpassword = mysqli_real_escape_string($con, $_POST['cpassword']);
        if($password !== $cpassword){
            $errors['password'] = "Confirm password not matched!";
        }else{
            $code = 0;
            $email = $_SESSION['EMAILADD']; //getting this email using session
            $encpass = sha1($password);
            $update_pass = "UPDATE tblcustomer SET ZIPCODE = $code, CUSPASS = '$encpass' WHERE EMAILADD = '$email'";
            $run_query = mysqli_query($con, $update_pass);
            if($run_query){
                $info = "Your password has been reset. You can now login with your new password.";
                $_SESSION['info'] = $info;
                header('Location: password-changed.php');
            }else{
                $errors['db-error'] = "Failed to change your password!";
            }
        }
    }
    
   //if login now button click
   // if(isset($_POST['login-now'])){
     //   header('Location: login.php');
    //}
?>
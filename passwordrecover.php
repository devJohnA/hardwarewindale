<title>Password Recovery | Windale Hardware</title>
<link href="css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="js/bootstrap.min.js"></script>
<script src="jquery/jquery.min.js"></script>
<link rel="icon" href="theme/KLA.png">
<link rel="stylesheet" href="font/css/font-awesome.min.css">
<style type="text/css">
.form-gap {
    padding-top: 70px;
}
</style>
<?php 



  //require('twilio-php-main/src/Twilio/autoload.php');
 require __DIR__ . '/Twilio/Autoload.php';

// Use the REST API Client to make requests to the Twilio REST API
use Twilio\Rest\Client;


//define the core paths
//Define them as absolute peths to make sure that require_once works as expected

//DIRECTORY_SEPARATOR is a PHP Pre-defined constants:
//(\ for windows, / for Unix)
defined('DS') ? null : define('DS', DIRECTORY_SEPARATOR);

defined('SITE_ROOT') ? null : define ('SITE_ROOT', $_SERVER['DOCUMENT_ROOT'].DS.'');

defined('LIB_PATH') ? null : define ('LIB_PATH',SITE_ROOT.DS.'include');

//load the database configuration first.
require_once(LIB_PATH.DS."config.php");
require_once(LIB_PATH.DS."function.php");
require_once(LIB_PATH.DS."session.php");
require_once(LIB_PATH.DS."accounts.php");
require_once(LIB_PATH.DS."autonumbers.php");
require_once(LIB_PATH.DS."products.php");
require_once(LIB_PATH.DS."stockin.php");
require_once(LIB_PATH.DS."categories.php");
require_once(LIB_PATH.DS."sidebarFunction.php"); 
require_once(LIB_PATH.DS."promos.php");
require_once(LIB_PATH.DS."customers.php");
require_once(LIB_PATH.DS."orders.php");
require_once(LIB_PATH.DS."summary.php");
require_once(LIB_PATH.DS."settings.php");




require_once(LIB_PATH.DS."database.php");



  if (isset($_POST['recover-submit'])) {
    # code...
    $_SESSION['phonenumber'] = $_POST['phonenumber'];
    $customer = New Customer();
    @$res = $customer->find_phone($_SESSION['phonenumber']);
    //echo $_SESSION['phonenumber'];
  
    if ($res) {
      # code...
      $code = mt_rand(100000,999999);
  
      $_SESSION['recovery_code'] = $code;
  

      // Your Account SID and Auth Token from twilio.com/console
      $account_sid = 'ACd3bbfc219398e4cbc9a53001b164444a';
      $auth_token = '19b34f9123a6a29030257082f8093a9d';
      // In production, these should be environment variables. E.g.:
      // $auth_token = $_ENV["TWILIO_AUTH_TOKEN"]
  
      // A Twilio number you own with SMS capabilities
      $twilio_number = "+13205372177";
      $number =  $_SESSION['phonenumber'];
      $send = "+63$number";
      //echo $send;
  
      $client = new Client($account_sid, $auth_token);
      $client->messages->create(
          // Where to send a text message (your cell phone?)
          $send,
          array(
              'from' => $twilio_number,
                'body' => 'Your MPLA OTP code is ' .$_SESSION['recovery_code']
          )
      );
  
      $sql = "INSERT INTO `messagein` (`Id`, `SendTime`, `MessageFrom`, `MessageTo`, `MessageText`) VALUES ('', '', 'Administrator', '".$_SESSION['phonenumber']."', '".'OTP number is ' .$_SESSION['recovery_code']."')";
    $mydb->setQuery($sql);
    $mydb->executeQuery();

      redirect('passwordrecover.php?code');
    }else{
      $phonemessage = '<p>Your phone number is incorrect.</p>';
    }
  }
  if (isset($_POST['validatecode-submit'])) {
    # code... 
    if ($_SESSION['recovery_code']==$_POST['resetcode']) {
      # code...
        redirect('passwordrecover.php?resetpassword');
    }else{
      $codemessage = '<p>Your code is incorrect.</p>';
    }
  }
  if (isset($_POST['savepass-submit'])) {
    # code...
  
    $customer = New Customer();
        $res = $customer->find_phone($_SESSION['phonenumber']);
        if ($res) {
          # code...

      $customer = New Customer();   
      $customer->CUSPASS      = sha1($_POST['newpassword']);  
      $customer->update($res->CUSTOMERID);

        }

    unset($_SESSION['phonenumber']);
    unset($_SESSION['recovery_code']);

   redirect('passwordrecover.php?success');
  }

?>
<div class="form-gap"></div>
<?php if (isset($_GET['code'])) { ?>
<div class="container">
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="text-center">
                        <h3><i class="fa fa-lock fa-4x"></i></h3>
                        <h2 class="text-center">Forgot Password?</h2>
                        <p>Put your code here.</p>
                        <?php echo isset($codemessage) ? $codemessage : "";?>
                        <div class="panel-body">

                            <form id="register-form" role="form" autocomplete="off" class="form" method="post">

                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-code color-blue"></i></span>
                                        <input id="resetcode" name="resetcode" placeholder="Input your Code Number here"
                                            class="form-control" type="text" required="true">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input name="validatecode-submit" class="btn btn-lg btn-primary btn-block"
                                        value="Submit" type="submit">
                                    <a href="index.php">Back to site</a>
                                </div>
                                <input type="hidden" class="hide" name="token" id="token" value="">
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php  }elseif(isset($_GET['resetpassword'])){ ?>
<div class="container">
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="text-center">
                        <h3><i class="fa fa-lock fa-4x"></i></h3>
                        <h2 class="text-center">Forgot Password?</h2>
                        <p>Change your password.</p>
                        <div class="panel-body">

                            <form id="register-form" role="form" autocomplete="off" class="form" method="post">

                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-user color-blue"></i></span>
                                        <input id="newpassword" name="newpassword" placeholder="New Password"
                                            class="form-control" type="password" required="true">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input name="savepass-submit" class="btn btn-lg btn-primary btn-block" value="Save"
                                        type="submit">
                                    <a href="index.php">Back to site</a>
                                </div>
                                <input type="hidden" class="hide" name="token" id="token"
                                    value="<?php echo $_SESSION['phonenumber']; ?>">
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php  }elseif(isset($_GET['success'])){ ?>
<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-4">
            <h2 style="color: blue">Password has been change</h2>
            <a href="index.php">Back to login</a>
        </div>
    </div>
    <?php  }else{ ?>
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="text-center">
                            <h3><i class="fa fa-lock fa-4x"></i></h3>
                            <h2 class="text-center">Forgot Password?</h2>
                            <p>You can reset your password here.</p>
                            <?php echo isset($phonemessage) ? $phonemessage : "";?>
                            <div class="panel-body">

                                <form id="register-form" role="form" autocomplete="off" class="form" method="post">

                                    <div class="form-group">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-phone color-blue"></i>
                                                +63</span>
                                            <input id="phonenumber" name="phonenumber"
                                                placeholder="Enter your Phone Number" class="form-control" type="text"
                                                required="true">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <input name="recover-submit" class="btn btn-lg btn-primary btn-block"
                                            value="Send" type="submit">
                                        <a href="index.php">Back to site</a>
                                    </div>
                                    <input type="hidden" class="hide" name="token" id="token" value="">
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php } ?>

    <!-- hoping this will be push -->
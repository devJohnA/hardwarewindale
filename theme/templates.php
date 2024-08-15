<?php

function isActive($page, $current_page) {
    return $page === $current_page ? 'active' : '';
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Home | Windale Hardware</title>
    <link rel="icon" href="<?php echo web_root; ?>img/windales.png">
    <link href="<?php echo web_root; ?>font/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <link href="<?php echo web_root; ?>font/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/prettyPhoto.css" rel="stylesheet">
    <link href="css/price-range.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
    <link href="css/main.css" rel="stylesheet">
    <link href="css/responsive.css" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->
    <link rel="shortcut icon" href="images/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="images/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="images/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="images/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="images/ico/apple-touch-icon-57-precomposed.png">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<!--/head-->
<!-- <style>
@import url('https://fonts.googleapis.com/css?family=Poppins:400,500,600,700&display=swap');

#click{
  display: none;
}
label{
  position: absolute;
  right: 30px;
  bottom: 20px;
  height: 55px;
  width: 55px;
  background: -webkit-linear-gradient(left, #a445b2, #fa4299);
  text-align: center;
  line-height: 55px;
  border-radius: 50px;
  font-size: 30px;
  color: #fff;
  cursor: pointer;
}
label i{
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  transition: all 0.4s ease;
}
label i.fas{
  opacity: 0;
  pointer-events: none;
}
#click:checked ~ label i.fas{
  opacity: 1;
  pointer-events: auto;
  transform: translate(-50%, -50%) rotate(180deg);
}
#click:checked ~ label i.fab{
  opacity: 0;
  pointer-events: none;
  transform: translate(-50%, -50%) rotate(180deg);
}
.wrapper{
  position: absolute;
  right: 30px;
  bottom: 0px;
  max-width: 400px;
  background: #fff;
  border-radius: 15px;
  box-shadow: 0px 15px 20px rgba(0,0,0,0.1);
  opacity: 0;
  pointer-events: none;
  transition: all 0.6s cubic-bezier(0.68,-0.55,0.265,1.55);
}
#click:checked ~ .wrapper{
  opacity: 1;
  bottom: 85px;
  pointer-events: auto;
}
.wrapper .head-text{
  line-height: 60px;
  color: #fff;
  border-radius: 15px 15px 0 0;
  padding: 0 20px;
  font-weight: 500;
  font-size: 20px;
  background: -webkit-linear-gradient(left, #a445b2, #fa4299);
}
.wrapper .chat-box{
  padding: 20px;
  width: 100%;
}
.chat-box .desc-text{
  color: #515365;
  text-align: center;
  line-height: 25px;
  font-size: 17px;
  font-weight: 500;
}
.chat-box form{
  padding: 10px 15px;
  margin: 20px 0;
  border-radius: 25px;
  border: 1px solid lightgrey;
}
.chat-box form .field{
  height: 50px;
  width: 100%;
  margin-top: 20px;
}
.chat-box form .field:last-child{
  margin-bottom: 15px;
}
form .field input,
form .field button,
form .textarea textarea{
  width: 100%;
  height: 100%;
  padding-left: 20px;
  border: 1px solid lightgrey;
  outline: none;
  border-radius: 25px;
  font-size: 16px;
  transition: all 0.3s ease;
}
form .field input:focus,
form .textarea textarea:focus{
  border-color: #fc83bb;
}
form .field input::placeholder,
form .textarea textarea::placeholder{
  color: silver;
  transition: all 0.3s ease;
}
form .field input:focus::placeholder,
form .textarea textarea:focus::placeholder{
  color: lightgrey;
}
.chat-box form .textarea{
  height: 70px;
  width: 100%;
}
.chat-box form .textarea textarea{
  height: 100%;
  border-radius: 50px;
  resize: none;
  padding: 15px 20px;
  font-size: 16px;
}
.chat-box form .field button{
  border: none;
  outline: none;
  cursor: pointer;
  color: #fff;
  font-size: 18px;
  font-weight: 500;
  background: -webkit-linear-gradient(left, #a445b2, #fa4299);
  transition: all 0.3s ease;
}
.chat-box form .field button:active{
  transform: scale(0.97);
}</style> -->

<?php
if (isset($_SESSION['gcCart'])){
  if (@count($_SESSION['gcCart'])>0) {
    $cart = '<span class="carttxtactive">('.@count($_SESSION['gcCart']) .')</span>';
  } 
 
} 
 ?>

<script type="text/javascript">


</script>
</head>

<body style="background-color:white" onload="totalprice()">

    <header id="header">
        <!--header-->
        <div class="header-middle">
            <!--header-middle-->
            <div class="container">
                <div class="row">
                    <div class="col-md-4 clearfix">
                        <div class="logo pull-left">
                            <!-- <a href="<?php echo web_root?>"><img src="images/home/logo.png" alt="" /></a> -->
                        </div>
                    </div>
                    <div class="col-md-8 clearfix">
                        <div class="shop-menu clearfix pull-right">
                            <ul class="nav navbar-nav">
                                <li><a href="<?php echo web_root;?>index.php?q=cart" class="<?php echo isActive('cart', $view); ?>"><i class="fa fa-shopping-cart"></i>
                                        Cart</a></li>
                                <?php if (isset($_SESSION['CUSID'] )) { ?>
                                <li><a href="<?php echo web_root?>index.php?q=profile" class="<?php echo isActive('profile', $view); ?>"><i class="fa fa-user"></i>
                                        Account</a></li>
                                <li><a href="<?php echo web_root?>logout.php" id="logoutLink"><i class="fa fa-lock"></i> Logout</a></li>
                                <?php }else{ ?>
                                <li><a href="onlinecustomer/index.php"><i class="fa fa-lock"></i>
                                        Sign in</a></li>
                                <?php } ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--/header-middle-->

        <div class="header-bottom">
            <!--header-bottom-->
            <div class="container">
                <div class="row">
                    <div class="col-sm-9">
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle" data-toggle="collapse"
                                data-target=".navbar-collapse">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                        </div>
                        <div class="mainmenu pull-left">
                            <ul class="nav navbar-nav collapse navbar-collapse">
                                <li><a href="<?php echo web_root;?>" class="<?php echo isActive('', $view); ?>">Home</a></li>
                                <li class="dropdown"><a href="#">Shop<i class="fa fa-angle-down"></i></a>
                                    <ul role="menu" class="sub-menu">
                                        <?php 
                                            $mydb->setQuery("SELECT * FROM `tblcategory`");
                                            $cur = $mydb->loadResultList();
                                           foreach ($cur as $result) { 
                                       echo '<li><a href="index.php?q=product&category='.$result->CATEGORIES.'" >'.$result->CATEGORIES.'</a></li>';
                                        } ?>
                                    </ul>
                                </li>


                                <li><a href="<?php web_root?>index.php?q=product" class="<?php echo isActive('product', $view); ?>">Products</a></li>
                                <li><a href="<?php web_root?>index.php?q=contact" class="<?php echo isActive('contact', $view); ?>">Contact</a></li>
                            </ul>
                        </div>
                    </div>
                    <!-- <div class="col-sm-3">
                        <form action="<?php echo web_root?>index.php?q=product" method="POST">
                            <div class="pull-right ">
                                <input type="text" name="search" placeholder="Search" style="border-color:#f9f9f9;" />
                                <button type="submit" class="btn btn-danger"><i class="fa fa-search"></i></button>
                            </div>
                        </form>
                    </div> -->
                </div>
            </div>
        </div>
        <!--/header-bottom-->
    </header>
    <!--/header-->






    <?php 
            require_once $content; 
         ?>






    <!--/Footer-->

    <!-- modalorder -->
    <div class="modal fade" id="myOrdered">
    </div>


    <?php include "LogSignModal.php"; ?>
    <!-- end -->

    <!-- <input type="checkbox" id="click">
      <label for="click">
      <i class="fab fa-facebook-messenger"></i>
      <i class="fas fa-times"></i>
      </label>
      <div class="wrapper">
         <div class="head-text">
            Let's chat? - Online
         </div>
         <div class="chat-box">
            <div class="desc-text">
               Please fill out the form below to start chatting with the next available agent.
            </div>
            <form action="#">
               <div class="field">
                  <input type="text" placeholder="Your Name" required>
               </div>
               <div class="field">
                  <input type="email" placeholder="Email Address" required>
               </div>
               <div class="field textarea">
                  <textarea cols="30" rows="10" placeholder="Explain your queries.." required></textarea>
               </div>
               <div class="field">
                  <button type="submit">Start Chat</button>
               </div>
            </form>
         </div>
      </div> -->
    <!-- jQuery -->
    <script src="<?php echo web_root; ?>jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo web_root; ?>js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <!-- DataTables JavaScript -->
    <script src="<?php echo web_root; ?>js/jquery.dataTables.min.js"></script>
    <script src="<?php echo web_root; ?>js/dataTables.bootstrap.min.js"></script>


    <script type="text/javascript" language="javascript" src="<?php echo web_root; ?>js/ekko-lightbox.js"></script>
    <script type="text/javascript" src="<?php echo web_root; ?>js/bootstrap-datetimepicker.js" charset="UTF-8"></script>
    <script type="text/javascript" src="<?php echo web_root; ?>js/locales/bootstrap-datetimepicker.uk.js"
        charset="UTF-8"></script>


    <script src="<?php echo web_root; ?>js/jquery.scrollUp.min.js"></script>
    <script src="<?php echo web_root; ?>js/price-range.js"></script>
    <script src="<?php echo web_root; ?>js/jquery.prettyPhoto.js"></script>
    <script src="<?php echo web_root; ?>js/main.js"></script>

    <!-- Custom Theme JavaScript -->
    <script type="text/javascript" language="javascript" src="<?php echo web_root; ?>js/janobe.js"></script>
    <script type="text/javascript">
    $(document).on("click", ".proid", function() {
        // var id = $(this).attr('id');
        var proid = $(this).data('id')
        // alert(proid)
        $(".modal-body #proid").val(proid)

    });
    </script>
    <script>
    // tooltip demo
    $('.tooltip-demo').tooltip({
        selector: "[data-toggle=tooltip]",
        container: "body"
    })

    // popover demo
    $("[data-toggle=popover]")
        .popover()
    </script>


    <script>
    $('.carousel').carousel({
        interval: 5000 //changes the speed
    })
    </script>

    <script type="text/javascript">
    $('#date_picker').datetimepicker({
        format: 'mm/dd/yyyy',
        language: 'en',
        weekStart: 1,
        todayBtn: 1,
        autoclose: 1,
        todayHighlight: 1,
        startView: 2,
        minView: 2,
        forceParse: 0
    });




    function validatedate() {



        var todaysDate = new Date();

        var txtime = document.getElementById('ftime').value
        // var myDate = new Date(dateme); 

        var tprice = document.getElementById('alltot').value
        var BRGY = document.getElementById('BRGY').value
        var onum = document.getElementById('ORDERNUMBER').value


        var mytime = parseInt(txtime);
        var todaytime = todaysDate.getHours();
        if (txtime == "") {
            alert("You must set the time enable to submit the order.")
        } else
        if (mytime < todaytime) {
            alert("Selected time is invalid. Set another time.")
        } else {
            window.location = "index.php?page=7&price=" + tprice + "&time=" + txtime + "&BRGY=" + BRGY +
                "&ordernumber=" + onum;
        }
    }
    </script>


    <script type="text/javascript">
    $('.form_curdate').datetimepicker({
        language: 'en',
        weekStart: 1,
        todayBtn: 1,
        autoclose: 1,
        todayHighlight: 1,
        startView: 2,
        minView: 2,
        forceParse: 0
    });
    $('.form_bdatess').datetimepicker({
        language: 'en',
        weekStart: 1,
        todayBtn: 1,
        autoclose: 1,
        todayHighlight: 1,
        startView: 2,
        minView: 2,
        forceParse: 0
    });
    </script>
    <script>
    function checkall(selector) {
        if (document.getElementById('chkall').checked == true) {
            var chkelement = document.getElementsByName(selector);
            for (var i = 0; i < chkelement.length; i++) {
                chkelement.item(i).checked = true;
            }
        } else {
            var chkelement = document.getElementsByName(selector);
            for (var i = 0; i < chkelement.length; i++) {
                chkelement.item(i).checked = false;
            }
        }
    }

    function checkNumber(textBox) {
        while (textBox.value.length > 0 && isNaN(textBox.value)) {
            textBox.value = textBox.value.substring(0, textBox.value.length - 1)
        }
        textBox.value = trim(textBox.value);
    }
    //
    function checkText(textBox) {
        var alphaExp = /^[a-zA-Z]+$/;
        while (textBox.value.length > 0 && !textBox.value.match(alphaExp)) {
            textBox.value = textBox.value.substring(0, textBox.value.length - 1)
        }
        textBox.value = trim(textBox.value);
    }


    document.getElementById('logoutLink').addEventListener('click', function(e) {
    e.preventDefault();
    
    Swal.fire({
        title: 'Are you sure?',
        text: "You will be logged out of your account.",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, logout!'
    }).then((result) => {
        if (result.isConfirmed) {
            // If user confirms, send AJAX request to logout.php
            fetch('<?php echo web_root?>logout.php', {
                method: 'POST',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    Swal.fire(
                        'Logged Out!',
                        data.message,
                        'success'
                    ).then(() => {
                        // Redirect to home page or login page
                        window.location.href = '<?php echo web_root?>index.php';
                    });
                } else {
                    Swal.fire(
                        'Error',
                        'There was a problem logging out.',
                        'error'
                    );
                }
            })
            .catch(error => {
                console.error('Error:', error);
                Swal.fire(
                    'Error',
                    'There was a problem logging out.',
                    'error'
                );
            });
        }
    });
});
    </script>

</body>

</html>
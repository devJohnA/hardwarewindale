<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup Form</title>
    <link href="bootstrap.min.css" rel="stylesheet">
</head>
<style>
    /* Add custom styles here */
    .top-margin {
        margin-top: 50px;
    }

    .form-group {
        margin-top: 13px;
        width: 450px;
        margin-left: 20px;
    }

    .bg {
        background-color: #67a3b1;
        border: none;
        color: white;
        width: 150px;
    }
</style>

<body>
    <?php

    if (!isset($_SESSION['USERID'])) {


        function redirect($url)
        {
            header("Location: $url");
            exit();
        }
    }



    // $autonum = New Autonumber();

    // $res = $autonum->single_autonumber(2);



    ?>

    <div class="container">
        <div class="row justify-content-center top-margin">
            <div class="col-lg-6">
                <h2 class="text-center " style="margin-bottom: 25px; font-size: 2.2rem;
    color: #444;">Signup | Admin</h2>
                <form class="form-horizontal" action="user/controller.php?action=add" method="POST" onsubmit="return validateForm() && registerSuccessAlert()">
                    <div class="form-group">

                        <div class="col-md-8 offset-md-3 ">

                            <div class="col-md-8">
                                <select class="form-control input-sm" name="U_ROLE" id="U_ROLE">

                                    <option value="Administrator">Administrator</option>
                                    <option value="Staff">Staff</option>
                                    <!-- <option value="Customer">Customer</option> -->



                                </select>

                            </div>

                        </div>

                    </div>

                    <div class="form-group">
                        <label for="U_NAME">Name:</label>
                        <input class="form-control" id="U_NAME" name="U_NAME" placeholder="Account Name" type="text" value="">
                    </div>

                    <div class="form-group">
    <label for="U_USERNAME">Username:</label>
    <input class="form-control" id="U_USERNAME" name="U_USERNAME" placeholder="Username (example@gmail.com)" type="email" onblur="validateUsername(this.value)" value="" required>
</div>
                    <div class="form-group">
    <label for="U_CON">Contact No.:</label>
    <input class="form-control" id="U_CON" name="U_CON" placeholder="Contact Number" type="text" maxlength="11" title="Please enter only numbers" onkeypress="return isNumberKey(event)" required>
</div>


<div class="form-group">
    <label for="U_EMAIL">Email Address:</label>
    <input class="form-control" id="U_EMAIL" name="U_EMAIL" placeholder="Email Address (example@gmail.com)" type="email" onblur="validateEmail(this.value)" value="" required>
</div>

                    <div class="form-group">
                        <label for="U_PASS">Password:</label>
                        <input class="form-control" id="U_PASS" name="U_PASS" placeholder="Account Password" type="password" value="" required>
                    </div>

                    <div class="form-group">
                        <button class="btn btn-dark bg" name="save" type="submit"><span class="fa fa-save fw-fa"></span> Register</button>
                        <div class="text-right col-md-7 offset-md-5">
                            <p>Already have an account? <a href="login.php">Login</a></p>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>

    <script>
        function registerSuccessAlert() {
            alert("Registered Successfully!");
        }

        function isNumberKey(evt) {
        var charCode = (evt.which) ? evt.which : event.keyCode;
        if (charCode > 31 && (charCode < 48 || charCode > 57)) {
            return false;
        }
        return true;
    }

    function validateUsername(username) {
        if (username && !username.endsWith("@gmail.com")) {
            alert("Please enter a valid Gmail address (example@gmail.com)");
            return false;
        }
        return true;
    }

    function validateEmail(email) {
        if (email && !email.endsWith("@gmail.com")) {
            alert("Please enter a valid Gmail address (example@gmail.com)");
            return false;
        }
        return true;
    }

    function validateForm() {
        var username = document.getElementById("U_USERNAME").value;
        var email = document.getElementById("U_EMAIL").value;
        var contactNumber = document.getElementById("U_CON").value;

        if (!validateUsername(username)) {
            return false; 
        }

        if (!validateEmail(email)) {
            return false; 
        }
        if (contactNumber.length !== 11) {
        alert("Please enter a 11-digit contact number.");
        return false; 
    }

        return true; 
    }
    </script>
</body>

</html>
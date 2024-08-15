<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        html, body {
            height: 100%;
            background-color: #faf9f6;
            margin: 0;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .signup-container {
            max-width: 500px;
            width: 90%;
            padding: 2rem;
            background-color: #fff;
            border-radius: 0.5rem;
            box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.1);
        }
        .btn-danger {
            background-color: #fd2323;
        }
        .btn-danger:hover {
            background-color: #f71d1d;
        }
        .password-container {
            position: relative;
        }
        .password-toggle {
            position: absolute;
            top: 50%;
            right: 10px;
            transform: translateY(-50%);
            cursor: pointer;
        }
        .start-end {
            text-align: right;
        }
        .terms{
            cursor:pointer;
        }
    </style>
</head>
<body>
    <div class="signup-container">
        <h2 class="text-center mb-3">Sign Up</h2>
        <p class="text-center mb-4">Please fill in the details to sign up!</p>
        <form id="signupForm" name="personal" method="POST" enctype="multipart/form-data">
        <input class="proid" type="hidden" name="proid" id="proid" value="">
            <div class="row mb-3">
                <div class="col">
                    <input type="text"  id="FNAME" name="FNAME" class="form-control" placeholder="First name" required>
                </div>
                <div class="col">
                    <input type="text" id="LNAME" name="LNAME" class="form-control" placeholder="Last name" required>
                </div>
            </div>
            <div class="mb-3">
                <select  id="GENDER" name="GENDER" class="form-select" required>
                    <option value="" selected disabled>Select Gender</option>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                </select>
            </div>
            <div class="mb-3">
                <textarea class="form-control" id="CITYADD" name="CITYADD" rows="3" placeholder="Street/Brgy./Municipality/Province" value=""  required></textarea>
            </div>
            <div class="mb-3">
                <input type="email"  id="CUSUNAME" name="CUSUNAME" class="form-control" placeholder="Email" required>
            </div>
            <div class="mb-3 password-container">
                <input type="password" class="form-control" id="CUSPASS" name="CUSPASS" placeholder="Password" required>
                <span class="password-toggle" onclick="togglePassword()">
                    <i class="fas fa-eye" id="toggleIcon"></i>
                </span>
            </div>
            <div class="mb-3">
                <input type="tel" id="PHONE" name="PHONE" value="" pattern="\d{11}" class="form-control" placeholder="Contact Number" required>
            </div>

            <div class="mb-3">
            <input type="checkbox" id="conditionterms" name="conditionterms"
                                                             value="checkbox" required>
                                                         By <small>clicking this box, you are agreeing the <a
                                                                 class="toggle-modal"
                                                                 onclick=" OpenPopupCenter('../customer/terms.php','Terms And Conditions','600','600')"><b class="terms">terms
                                                                     and conditions</b></a></small>
            </div>
            <button type="submit" name="submit" class="btn btn-danger w-100 mb-3">Sign Up</button>
            <p class="text-center mb-0">Already have an account? <a href="index.php" class="text-danger">Sign In</a></p>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function togglePassword() {
            const passwordInput = document.getElementById('CUSPASS');
            const toggleIcon = document.getElementById('toggleIcon');
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                toggleIcon.classList.remove('fa-eye');
                toggleIcon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                toggleIcon.classList.remove('fa-eye-slash');
                toggleIcon.classList.add('fa-eye');
            }
        }

        function OpenPopupCenter(pageURL, title, w, h) {
    var left = (screen.width - w) / 2;
    var top = (screen.height - h) / 4; // for 25% - devide by 4  |  for 33% - devide by 3
    var targetWin = window.open(pageURL, title,
        'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=no, copyhistory=no, width=' +
        w + ', height=' + h + ', top=' + top + ', left=' + left);
}

document.getElementById('signupForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    let formData = new FormData(this);
    formData.append('submit', 'true'); // Add this line to ensure 'submit' is sent

    fetch('../customer/controller.php?action=add', {
        method: 'POST',
        body: formData
    })
    .then(response => response.text())
    .then(text => {
        console.log('Raw server response:', text);
        return JSON.parse(text);
    })
    .then(data => {
        if (data.status === 'info') {
            Swal.fire({
                icon: 'info',
                title: 'Oops...',
                text: data.message,
            });
        } else if (data.status === 'success') {
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: data.message,
                showConfirmButton: false,
                timer: 1500
            }).then(() => {
                window.location.href = data.redirect;
            });
        }
    })
    .catch(error => {
        console.error('Error:', error);
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Something went wrong: ' + error.message,
        });
    });
});

    </script>
</body>
</html>

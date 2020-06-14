<?php
//require 'models/db.php';

require '../../controllers/login_controller.php';

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta id="Viewport" name="viewport" content="initial-scale=1, maximum-scale=1,
        minimum-scale=1, user-scalable=no">
    <title>Plant Diagnosis System</title>
    <link rel="stylesheet" href="../../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../assets/css/toastr.min.css">
    <link rel="stylesheet" href="../../assets/css/main.css">
    <link rel="stylesheet" href="../../assets/css/material_design_input_field.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/material-design-icons/3.0.1/iconfont/material-icons.min.css">
    <link rel="stylesheet" href="../../assets/js/toastr.min.js">
</head>
<body>
    <div class="container col-sm-12 col-md-8 col-lg-8">
        <nav class="d-flex justify-content-center shadow">
            <h5 class="text-blueGray p-2">Plant Diagnosis System</h5>
        </nav>

        <div class="container col-md-8">
            <form method="post" action="login_page.php" style="margin-top: 27.5%">
                <div class="form-group">
                    <input type="text" name="email" id="emailField" required class="input-area">
                    <label for="emailField" class="label">Email</label>
                    <span class="inputFieldIconStyle"><i class="material-icons text-secondary">email</i></span>
                    <span style="display: block"><?php echo "$emailError" ?></span>
                </div>
                <div class="form-group" style="margin-top: 15px">
                    <input type="text" name="password" id="passwordField" required class="input-area">
                    <label for="passwordField" class="label">Password</label>
                    <span class="inputFieldIconStyle"><i class="material-icons text-secondary">security</i></span>
                    <span style="display: block"><?php echo "$emailError" ?></span>
                </div>
                <p class="text-center text-secondary">Already Registered?</p>
                <div class="text-center">
                    <input type="submit" name="signInSubmit" class="btn text-success w-100" style="font-size: 25px" value="Sign In">
                    <a href="forgot_password.php" class="text-info w-100" style="text-decoration: none">Forgot Password?</a>
                </div>
                <div class="text-center mt-2">
                    <a href="signup_page.php" class="text-info w-100" style="text-decoration: none">New to Plant Diagnosis System? Sign Up</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="css/animate.min.css">
    <link rel="stylesheet" type="text/css"  href="css/registration.css">
    <title>Registration</title>
    <style>

    </style>
</head>
<body>

    <div class="background-overlay"></div>

    <div class="container">
       <h2 class="text-center fw-bold mb-4 "><a href="index.php" class="home-peddle">Peddle</a></h2>
        <p class="text-center text-muted mb-4 "> Create your Peddle account</p>
<!-- Beginning of Session Error message -->
        <?php
            if(isset($_SESSION["errormsg"])){
        ?>
            <div class="custom-alert error-alert">
            <span class="error-icon">⚠️</span>
            <span class="error-message">
                    <?php
                        echo $_SESSION["errormsg"];
                        unset($_SESSION["errormsg"]);
                    ?>
            </span>
            <button class="close-btn" onclick="this.parentElement.style.display='none'">&times;</button>
            </div>
        <?php
            }
        ?>
<!-- End of Session Error message  -->

        
        <form action="process/registration_process.php" method="post">
            <div class="row">
                <div class="col-md-6 mb-3 input-container">
                    <label for="firstName" class=" text-muted">First Name <span class="text-danger">*</span></label>
                    <img src="images2/user.png" alt="User Icon" class="input-icon">
                    <input name="first_name" type="text" class="form-control" id="firstName" placeholder="First Name">
                </div>
                <div class="col-md-6 mb-3 input-container">
                    <label for="lastName" class=" text-muted">Last Name <span class="text-danger">*</span></label>
                    <img src="images2/user.png" alt="User Icon" class="input-icon">
                    <input name="last_name" type="text" class="form-control" id="lastName" placeholder="Last Name">
                </div>
            </div>

            <div class="row">
                <div class="col-md-12 mb-3 input-container">
                    <label for="email" class="text-muted">Email <span class="text-danger">*</span></label>
                    <img src="images2/email.png" alt="User Icon" class="input-icon">
                    <input type="email" name="email" id="email" placeholder="Email"  class="form-control">
                </div>
            </div>

            <div class="row">
                <label for="phone_number" class="text-muted"> Phone Number <span class="text-danger">*</span></label>
                <div class="col-md-4 mb-3 input-container">
                    <!-- <label for="countryCode" class="form-label">Country Code</label> -->
                    <select name="country_code" id="country_code"  class="form-select " placeholder="Phone Number" >
                        <!-- <option value="" disabled selected>+ Code</option> -->
                        <option value="+1" > 🇳🇬 +234</option>
                        <option value="+1">+1</option>
                        <option value="+44"> +44 </option>
                        <option value="+91"> +91 </option>
                        <option value="+27"> +27 </option>
                        <option value="+233"> +233 </option>
                        <option value="+250"> +250 </option>
                        <option value="+255"> +255 </option>
                    </select>
                </div>
                <div class="col-md-8 mb-3 input-container">
                    <img src="images2/phone.png" alt="User Icon" class="input-phone">
                    <input type="text" class="form-control" name="phone_number" id="phone_number" placeholder="Phone Number">
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3 input-container">
                    <label for="password" class="text-muted">Password <span class="text-danger">*</span></label>
                    <img src="images2/eye.png" alt="Toggle Password" class="input-icon" id="togglePassword">
                    <input name="password" type="password" class="form-control" id="password" placeholder="Password">
                </div>
                <div class="col-md-6 mb-3 input-container">
                    <label for="confirm_password" class="text-muted">Confirm Password <span class="text-danger">*</span></label>
                    <img src="images2/eye.png" alt="Toggle Password" class="input-icon" id="togglePassword">
                    <input name="confirm_password" type="password" class="form-control" id="confirm_password" placeholder="Confirm Password">
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-12">
                    <div class="form-check">
                        <input name="agree_terms" value="agree" class="form-check-input" type="checkbox" id="terms" >
                        <label class="text-muted terms" for="terms">
                            I agree with Peddle's <a href="#" class="user_agreement fw-bold">User Agreement</a> and <a href="#" class="privacy_policy fw-bold">Privacy Policy</a>.
                        </label>
                    </div>
                </div>
            </div>   


            <button name="reg_btn" class="btn w-100 login-button">Next</button>
        </form>
    </div>


    
    <script src="jquerymin.js"></script>
    <script src="bootstrap/js/bootstrap.bundle.js" type="text/javascript"></script>
    <script src="swiper/js/swiper-bundle.min.js"></script>
    <script src="swiper/js/swiper-init.js"></script>
    <script src="js/peddle.js"></script>
</body>
</html>


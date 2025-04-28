<?php
session_start();
// print_r($_SESSION);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css"  href="bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="swiper/css/swiper-bundle.min.css" />
    <link rel="stylesheet" type="text/css" href="css/animate.min.css">
    <link rel="stylesheet" type="text/css"  href="css/login.css">
    <title>Peddle-Login</title>
    <style>

  
.custom-alert1 {
    display: flex;
    align-items: center;
    justify-content: space-between;
    background-color: #ffcccc;
    color: #a94442; 
    font-size: 14px;
    padding: 8px 12px;
    border: 1px solid #a94442;
    border-radius: 5px;
    max-width: 400px;
    margin: 10px auto;
    box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.1);
    animation: fadeIn 0.3s ease-in-out;
}

/* Error Icon */
.error-icon {
    font-size: 16px;
    margin-right: 8px;
}

/* Close Button */
.close-btn {
    background: none;
    border: none;
    color: #a94442;
    font-size: 18px;
    cursor: pointer;
    padding: 0 5px;
}

/* Fade-in Animation */
@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translateY(-5px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}


.custom-alert2 {
    display: flex;
    align-items: center;
    justify-content: space-between;
    background-color: #d4edda;
    color: #155724;
    font-size: 14px;
    padding: 10px 15px;
    border: 1px solid #c3e6cb;
    border-radius: 5px;
    max-width: 400px;
    margin: 10px auto;
    box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.1);
    animation: fadeIn 0.3s ease-in-out;
}

/* Success Icon */
.success-icon {
    font-size: 16px;
    margin-right: 8px;
}

/* Close Button */
.close-btn {
    background: none;
    border: none;
    color: #155724;
    font-size: 18px;
    cursor: pointer;
    padding: 0 5px;
}

/* Fade-in Animation */
@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translateY(-5px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

    </style>
</head>
<body>

    <div class="container-fluid vh-100">
        <div class="row h-100 g-0">
    
<!-- Image Section -->
            <div class="col-md-8 d-none d-md-block p-0 h-100 login-image position-relative">
                <img src="images/login.jpg" alt="" class="img-fluid w-100 h-100 object-fit-cover">
                <div class="position-absolute top-0 start-0 w-100 h-100 bg-dark opacity-25"></div>
            </div>

<!-- Form Section -->
            <div class="col-md-4 d-flex align-items-center justify-content-center login-box">
                <div class="text-center w-75 ">
                        <h2 class="fw-bold "><a href="index.php" class="home-peddle">Peddle</a></h2>
                        <p class="text-muted">Sign in to continue your ride</p>
    
<!-- Beginning of Session Error message -->
<?php
            if(isset($_SESSION["errormsg"])){
        ?>
            <div class="custom-alert1 error-alert">
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

<!-- Beginning of Feedback Message -->
<?php
if (isset($_SESSION["feedback"])) {
?>
    <div class="custom-alert2 feedback-alert">
        <span class="success-icon">✔️</span>
        <span class="feedback-message">
            <?php
            echo $_SESSION["feedback"];
            unset($_SESSION["feedback"]);
            ?>
        </span>
        <button class="close-btn" onclick="this.parentElement.style.display='none'">&times;</button>
    </div>
<?php
}
?>
<!-- End of Feedback Message -->

                    <form action="process/login_process.php" method="post" class="mt-5 ">
                        <div class="mb-2 input-group ">
                            <label for="email" class="text-muted">Email</label>
                            <div class="input-container ">
                                <img src="images2/email.png" alt="User Icon" class="input-icon">
                                <input name="email" type="email" id="email" class="form-control" placeholder="Enter your email">
                            </div>
                        </div>
                        <div class="mb-4 input-group">
                            <label for="password" class="text-muted">Password</label>
                            <div class="input-container">
                                <input name="password" type="password" id="password" class="form-control" placeholder="Enter your password">
                                <img src="images2/eye.png" alt="Toggle Password" class="input-icon" id="togglePassword">
                            </div>
                        </div>
                        <button name="btn_login" type="submit" class="login-button btn  w-100">Login</button>
                    </form>
    
                    <p class="mt-3">
                        <a href="#" class="forgot_password text-muted">Forgot password?</a>
                    </p>
                    <p class="text-muted ">Don't have an account?  <a href="registration.php" class="forgot_password fw-bold">Sign Up</a></p>
                </div>
            </div>
    
        </div>
    </div>


    <script src="jquerymin.js"></script>
    <script src="bootstrap/js/bootstrap.bundle.js" type="text/javascript"></script>
    <script src="swiper/js/swiper-bundle.min.js"></script>
    <script src="swiper/js/swiper-init.js"></script>
    <script src="js/peddle.js"></script>
</body>
</html>
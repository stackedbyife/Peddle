<?php

session_start();    

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - Peddle</title>
    <link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="css/admin_login.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Pacifico&display=swap" rel="stylesheet">

</head>
<body>

    <div class="login-container">
        <h2><a href="../index.php" class="home-peddle">Peddle HQ</a></h2>
        <h2>Admin Login</h2>

<!-- Beginning of Session Error message -->
        <?php
            if(isset($_SESSION["adminerror"])){
        ?>
            <div class="custom-alert1 error-alert">
            <span class="error-icon"></span>
            <span class="error-message">
                    <?php
                        echo $_SESSION["adminerror"];
                        unset($_SESSION["adminerror"]);
                    ?>
            </span>
            <button class="close-btn" onclick="this.parentElement.style.display='none'">&times;</button>
            </div>
        <?php
            }
        ?>
<!-- End of Session Error message  -->

        <form action="process/process_admin.php" method="post">
            <div class="mb-3">
                <input type="email" name="email" class="form-control mb-3" placeholder="Email" required>
            </div>
            <div class="mb-3">
                <input type="password" name="password" class="form-control mb-3" placeholder="Password" required>
            </div>
            
            <!-- Centered button -->
            <div class="btn-container">
                <button name="btn_admin" type="submit" class="btn" value="button">Login</button>
            </div>
        </form>
    </div>

</body>
</html>
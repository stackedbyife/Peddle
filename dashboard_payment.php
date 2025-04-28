<?php
session_start();

require_once "member_guard.php";
require_once "classes/Member.php";
require_once "classes/Payment.php";
$id = $_SESSION["member_id"];
$member = new Member();
$details =$member -> get_member($id);

 $membership_id = $details["membership_type"];
$payment = new Payment();
$payment = $payment ->fetch_membership($membership_id);
$amount = $payment["membership_plan_amount"]*100;
// echo "<pre>";
//    print_r($amount);
// echo "</pre>";


?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="bootstrap/css/bootstrap.css" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />
  <link rel="stylesheet" type="text/css" href="css/animate.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="css/dashboard_css.css" />
  
  <title>Dashboard</title>
  <style>

@media (max-width: 768px) {
      #sidebar {
        position: fixed;
        top: 0;
        left: 0;
        width: 250px;
        height: 100%;
        z-index: 1050; 
        transform: translateX(-100%);
        transition: transform 0.3s ease-in-out;
      }

      #sidebar.show {
        transform: translateX(0);
      }
      .navbar-custom {
        position: relative;
        z-index: 1000; 
        width: 100%;
      }

      body {
        padding-top: 3rem;  
      }
      .name_peddle{
        margin-left: 60px;
      }
}



    /* Toggle button style */
    #sidebarToggle {
      position: fixed;
      top: 1rem;  
      left: 1rem;  
      z-index: 1060;  
      background-color: #073B4C;
      color: white;
      border: none;
      padding: 0.5rem 1rem;
      border-radius: 0.5rem;
    }
    #sidebarToggle:hover {
      background-color: #073B4C;  
    }
    #payment-form {
        background: linear-gradient(135deg,rgb(141, 148, 207), #6dffc9);
        border-radius: 20px;
        animation: fadeIn 1s ease-out;
        font-family: 'Poppins', sans-serif;
        color: #fff;
    }
    #payment-form h3,
    #payment-form p,
    #payment-form small,
    #payment-form button {
  font-family: 'Poppins', sans-serif;
  }

    #payment-form h3 {
        font-family: 'Arial', sans-serif;
        color: #fff;
        font-size: 2rem;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    #payment-form p {
        font-family: 'Arial', sans-serif;
        color: #fff;
        font-size: 1rem;
        opacity: 0.8;
    }

    #pay-btn {
        background-color: #4CAF50;
        border: none;
        transition: all 0.3s ease;
    }

    #pay-btn:hover {
        background-color: #45a049;
        transform: scale(1.05);
    }

    /* Animation for fading in */
    @keyframes fadeIn {
        0% { opacity: 0; }
        100% { opacity: 1; }
    }

    /* Shadow animation for the button */
    #pay-btn:active {
        transform: scale(0.98);
    }

    /* Card Hover Effect */
    #payment-form:hover {
        box-shadow: 0 15px 25px rgba(0, 0, 0, 0.1);
    }
    #payment-form {
    background: linear-gradient(135deg, #6290C8, #9D5C63);
    color: #F7F7F2;
    border-radius: 1.5rem;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

#payment-form:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 30px rgba(0, 0, 0, 0.15);
}

#payment-form h3 {
    font-family: 'Inter', sans-serif;
    font-size: 2.2rem;
    letter-spacing: 0.5px;
}

#payment-form p {
    font-family: 'Inter', sans-serif;
    opacity: 0.9;
}

.pay-btn {
  background-color: rgb(217, 229, 232);
  color: #032B43;
  font-family: 'Poppins', sans-serif;
  font-weight: 600;
  font-size: 1rem;
  padding: 0.75rem 2.5rem;
  border: none;
  border-radius: 0.75rem;
  transition: all 0.3s ease;
  box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
  letter-spacing: 0.5px;
}

.pay-btn:hover {
  background-color: #cfe1e5;
  transform: scale(1.05);
  box-shadow: 0 6px 18px rgba(0, 0, 0, 0.1);
}

.pay-btn:active {
    transform: scale(0.98);
}


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
<div class="container-fluid">
  <div class="row">
  <div class="col">
  <button class="d-md-none" id="sidebarToggle">
    <i class="bi bi-list fs-2"></i>
  </button>
  </div>
  </div>

  <div class="row ">
  <!-- Sidebar -->
  <div class="col-md-2 sidebar d-md-flex flex-column justify-content-between px-3" id="sidebar">
    <div>
    <h4 class="fw-bold name_peddle" style="font-family: 'Pacifico', cursive; font-size: 2rem;">Peddle</h4>
      <p class="text-uppercase text-white-50 small">Main Menu</p>
      <a href="dashboard.php" class="sidebar-link "><i class="bi bi-grid-fill me-2"></i> Dashboard</a>
      <a href="dashboard_rides.php" class="sidebar-link "><i class="fas fa-bicycle me-2"></i> Active Rides</a>
      <a href="dashboard_tracking.php" class="sidebar-link"><i class="bi bi-geo-alt-fill me-2"></i> Tracking</a>
      <a href="dashboard_history.php" class="sidebar-link"><i class="fas fa-history me-2"></i> Ride History</a>
      <a href="dashboard_payment.php" class="sidebar-link active"><i class="bi bi-credit-card-2-front-fill me-2"></i> Payments</a>
      <a href="#" class="sidebar-link"><i class="fas fa-id-card me-2"></i> Membership</a>
      <!-- <a href="#" class="sidebar-link d-flex justify-content-between align-items-center">
        <span><i class="bi bi-chat-dots-fill me-2"></i> Messages</span>
        <span class="badge bg-danger rounded-pill">1</span>
      </a> -->
      <p class="text-uppercase text-white-50 small mt-4">General</p>
      <a href="index.php" class="sidebar-link"><i class="bi bi-house-door-fill me-2"></i> Homepage</a>
      <a href="member_logout.php" class="sidebar-link"><i class="bi bi-box-arrow-right me-2"></i> Log out</a>
    </div>
  </div>
  <!-- End Sidebar -->

      <!-- Main Content -->
      <div class="col-md-10 px-0">
        <!-- Navbar -->
        <div class="navbar-custom d-flex align-items-center justify-content-between flex-wrap">
          <!-- Left Side -->
          <div class="d-flex align-items-center flex-wrap">
            <img src="images2/smile.gif" alt="logo" style="width: 40px; margin-right: 10px;" />
            <div>
              <div class="nav-welcome"></div>
              <div class="nav-subtext fw-bold">You can call me Emoji</div>
            </div>
  
          </div>

          <!-- Right Side -->
          <div class="d-flex align-items-center mt-3 mt-md-0">
            <button class="icon-btn"><i class="bi bi-search fs-5"></i></button>
            <button class="icon-btn position-relative">
              <i class="bi bi-bell fs-5"></i>
              <span class="notif-badge">4</span>
            </button>

<!-- Avatar Dp -->
            <div class="dropdown user-menu">
              <a class="btn dropdown-toggle p-0 border-0" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <img src="images2/<?php echo $details["member_avatar"]; ?>.png" class="avatar-img" alt="User Avatar" />
                <!-- <img src="images2/bot.png" alt=""> -->
              </a>
              <ul class="dropdown-menu user-profile">
                <li><a class="dropdown-item" href="profile.php">Profile</a></li>
                <li><a class="dropdown-item" href="center_dashboard.php">Change Password</a></li>
                <li><a class="dropdown-item" href="member_logout.php">Logout</a></li>
              </ul>
            </div>

          </div>
        </div>
<!-- End Navbar -->

<!-- Beginning of Feedback Message -->
<?php
if (isset($_SESSION["feedback"])) {
?>
    <div class="custom-alert2 feedback-alert mt-5 ">
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

<div class="col-md-12 px-3 mt-5 pt-4">
  <div class="card shadow p-5 rounded-4 border-0 animate__animated animate__fadeIn" id="payment-form">
    <h3 class="text-center text-light fw-bold mb-3">Make Payment</h3>
    <p class="text-center text-light mb-4">
      Your pedals are waiting! Make a payment now and unlock the magical world of two-wheeled adventures.  
      <br><small class="fst-italic"><i class="bi bi-info-circle me-1"></i> This button has been scientifically proven to bring joy... and receipts.</em></small>
    </p>
    
    <form action="process/process_payment.php" method="POST">
      <input type="hidden" name="amount" value="<?php echo $amount; ?>">
      <input type="hidden" name="email" value="<?php echo $details['email']; ?>">
      <input type="hidden" name="order_id" value="<?php echo uniqid('id_'); ?>">

      <div class="d-flex justify-content-center">
        <button type="submit" class="btn pay-btn fw-semibold px-5 py-3"><i class="bi bi-credit-card-2-front-fill me-2"></i>Pay Now</button>
      </div>
    </form>
  </div>
</div>



<script src="https://js.paystack.co/v1/inline.js"></script>
<?php
require_once "partials/mem_dash_footer.php";

?>
<?php
session_start();


require_once "member_guard.php";
require_once "classes/Member.php";
$id = $_SESSION["member_id"];
$member = new Member();
$details =$member -> get_member($id);

// echo "<pre>";
//    print_r($details);
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
        padding-top: 3.8rem;  
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
      <a href="dashboard.php" class="sidebar-link active"><i class="bi bi-grid-fill me-2"></i> Dashboard</a>
      <a href="dashboard_rides.php" class="sidebar-link "><i class="fas fa-bicycle me-2"></i> Active Rides</a>
      <a href="dashboard_tracking.php" class="sidebar-link"><i class="bi bi-geo-alt-fill me-2"></i> Tracking</a>
      <a href="dashboard_history.php" class="sidebar-link"><i class="fas fa-history me-2"></i> Ride History</a>
      <a href="dashboard_payment.php" class="sidebar-link"><i class="bi bi-credit-card-2-front-fill me-2"></i> Payments</a>
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
              <div class="nav-subtext fw-bold">Hi there, <?php echo $details["first_name"]; ?>!</div>
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



<!-- Widgets -->

        <div class="container my-4 mt-4">
          <div class="row g-4">
            <div class="col-md-4">
              <div class="widget">
                <h6>Membership</h6>
                <p class="text-danger mb-0">Inactive</p>
              </div>
            </div>
            <div class="col-md-4">
              <div class="widget">
                <h6>Verification</h6>
                <p class="text-danger mb-0">Awaiting address </p>
              </div>
            </div>
            <div class="col-md-4">
              <div class="widget">
                <h6>Active Ride</h6>
                <p class="mb-0 text-danger">No active rides currently</p>
              </div>
            </div>
          </div>
<!-- End of Profile Widgets -->

<!-- Begining of widgets -->
<div class="container mt-5 pt-2">
  <div class="row g-4">
    
    <div class="col-md-4 ">             
      <div class="card shadow-sm p-4 rounded-4 border-0 weather-card">
        <div class="d-flex align-items-center mb-2">
          <div class="rounded-circle d-flex justify-content-center align-items-center me-2 weather-icon">☀️</div>
          <h6 class="mb-0 fw-semibold ms-3"> Sunny, 32°C</h6>
        </div>
        <p class="mb-0 text-center mt-1" style="font-size: 0.95rem;">
          This sunshine was made for<br>
          <span style="font-size: 0.95rem;">cycling</span>!
        </p>
      </div>
    </div>

    <div class="col-md-4">
      <div class="card text-center shadow p-2  rounded-4 border-0 text-white goal-card">
        <h6 class="opacity-75">This Week's Goal</h6>
        <div class="progress-circle position-relative mx-auto " style="width: 100px; height: 100px;">
          <svg class="position-absolute top-0 start-0" width="100" height="100">
            <circle cx="50" cy="50" r="40" stroke="#ffffff44" stroke-width="10" fill="none"/>
            <circle class="progress-ring" cx="50" cy="50" r="40"
                    stroke="#ffffff" stroke-width="10" fill="none"
                    stroke-dasharray="251.2" stroke-dashoffset="250" stroke-linecap="round"/>
          </svg>
          <div class="position-absolute top-50 start-50 translate-middle fw-bold fs-5">2%</div>
        </div>
        <p class="mb-0 small opacity-75">Distance goal: 100km</p>
      </div>
    </div>

    <div class="col-md-4 ">
      <div class="card shadow-sm p-4 rounded-4 border-0 text-white ride-card text-center mx-auto">
        <div class="d-flex flex-column align-items-center mb-3">
          <div class="ride-icon rounded-circle d-flex justify-content-center align-items-center mb-2">
            🚴
          </div>
          <h6 class="mb-0 fw-semibold">Upcoming Ride</h6>
        </div>
        <p class="mb-0" style="font-size: 0.95rem;">
          You have no ride scheduled, you can book one 
        </p>
      </div>
    </div>

  </div>
</div>



<!-- End of widgets -->



  <!-- Dashboard Stats Section
  <div class="container py-5">
    <div class="row g-4">
  
      Total Rides
      <div class="col-md-6 col-lg-3">
        <div class="card p-4 shadow-sm border-0 rounded-4 text-white bg-primary position-relative">
          <div class="icon mb-3">
            <i class="fas fa-bicycle fa-2x"></i>
          </div>
          <h5 class="fw-bold mb-0">120</h5>
          <small>Total Rides</small>
        </div>
      </div>
  
      Total Distance
      <div class="col-md-6 col-lg-3">
        <div class="card p-4 shadow-sm border-0 rounded-4 text-white bg-success position-relative">
          <div class="icon mb-3">
            <i class="fas fa-road fa-2x"></i>
          </div>
          <h5 class="fw-bold mb-0">432 km</h5>
          <small>Total Distance</small>
        </div>
      </div>
  
      Time Spent
      <div class="col-md-6 col-lg-3">
        <div class="card p-4 shadow-sm border-0 rounded-4 text-white bg-warning position-relative">
          <div class="icon mb-3">
            <i class="fas fa-stopwatch fa-2x"></i>
          </div>
          <h5 class="fw-bold mb-0">16 hrs</h5>
          <small>Time Spent Riding</small>
        </div>
      </div>
  
      Wallet Balance
      <div class="col-md-6 col-lg-3">
        <div class="card p-4 shadow-sm border-0 rounded-4 text-white bg-dark position-relative">
          <div class="icon mb-3">
            <i class="fas fa-wallet fa-2x"></i>
          </div>
          <h5 class="fw-bold mb-0">₦3,200</h5>
          <small>Wallet Balance</small>
        </div>
      </div>
  
    </div>
  </div> -->
<!--End of Dashboard Stats Section -->

      </div>
    </div>
  </div>


  <?php
require_once "partials/mem_dash_footer.php";

?>
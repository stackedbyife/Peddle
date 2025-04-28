<?php
session_start();
require_once "../classes/Member.php";


// $member = new Member();


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
</head>
<body>
  <div class="container-fluid">
    <div class="row">

<button class="btn btn-outline-light d-md-none mb-3" id="sidebarToggle">
    <i class="bi bi-list fs-4"></i>
  </button>
  
  <!-- Sidebar -->
  <div class="col-md-2 sidebar d-none d-md-flex flex-column justify-content-between px-3" id="sidebar">
    <div>
      <h4 class="mb-4 fw-bold">Peddle</h4>
      <p class="text-uppercase text-white-50 small">Main Menu</p>
      <a href="#" class="sidebar-link active"><i class="bi bi-grid-fill me-2"></i> Dashboard</a>
      <a href="http://localhost/peddle/dashboard_rides.php" class="sidebar-link "><i class="fas fa-bicycle me-2"></i> Active Rides</a>
      <a href="" class="sidebar-link"><i class="bi bi-geo-alt-fill me-2"></i> Tracking</a>
      <a href="#" class="sidebar-link"><i class="fas fa-history me-2"></i> Ride History</a>
      <a href="#" class="sidebar-link"><i class="bi bi-credit-card-2-front-fill me-2"></i> Payments</a>
      <a href="#" class="sidebar-link"><i class="fas fa-id-card me-2"></i> Membership</a>
      <a href="#" class="sidebar-link d-flex justify-content-between align-items-center">
        <span><i class="bi bi-chat-dots-fill me-2"></i> Messages</span>
        <span class="badge bg-danger rounded-pill">5</span>
      </a>
      <p class="text-uppercase text-white-50 small mt-4">General</p>
      <a href="#" class="sidebar-link"><i class="bi bi-gear-fill me-2"></i> Settings</a>
      <a href="http://localhost/peddle/member_logout.php" class="sidebar-link"><i class="bi bi-box-arrow-right me-2"></i> Log out</a>
    </div>
  </div>
  <!-- End Sidebar -->

      <!-- Main Content -->
      <div class="col-md-10 px-0">
        <!-- Navbar -->
        <div class="navbar-custom d-flex align-items-center justify-content-between flex-wrap">
          <!-- Left Side -->
          <div class="d-flex align-items-center flex-wrap">
            <img src="https://cdn-icons-png.flaticon.com/512/833/833472.png" alt="logo" style="width: 40px; margin-right: 10px;" />
            <div>
              <div class="nav-welcome"></div>
              <div class="nav-subtext">Hi there, [Username]!</div>
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
                <img src="https://i.pravatar.cc/40" class="avatar-img" alt="User Avatar" />
              </a>
              <ul class="dropdown-menu user-profile">
                <li><a class="dropdown-item" href="center_dashboard.html">Profile</a></li>
                <li><a class="dropdown-item" href="center_dashboard.html">Change Password</a></li>
                <li><a class="dropdown-item" href="#">Logout</a></li>
              </ul>
            </div>

          </div>
        </div>
<!-- End Navbar -->
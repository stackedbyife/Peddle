<?php
session_start();

require_once "member_guard.php";
require_once "classes/Member.php";
$id = $_SESSION["member_id"];
$member = new Member();
$details = $member->get_member($id);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard</title>
  <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet" />

  <link rel="stylesheet" href="bootstrap/css/bootstrap.css" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />
  <link rel="stylesheet" href="css/dashboard_css.css" />
  <style>


    .map-container {
      height: 500px; 
      position: relative;
    }
    

    #map {
      width: 85%;
      height: 80%;
      border-radius: 20px;
      margin-left:32px;
    }

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
      <a href="dashboard_tracking.php" class="sidebar-link active"><i class="bi bi-geo-alt-fill me-2"></i> Tracking</a>
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
              <div class="nav-subtext fw-bold">I love maps</div>
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
                <li><a class="dropdown-item" href="center_dashboard.html">Change Password</a></li>
                <li><a class="dropdown-item" href="member_logout.php">Logout</a></li>
              </ul>
            </div>
          </div>
        </div>
        <!-- End Navbar -->

         <!-- Main Section -->
         <div class="container map-container mt-4">

          <div id="map"></div>


          <!-- Ride Metrics -->
          <div class="row mb-3 mt-5">
            <div class="col-md-4 mb-3">
              <div class="card text-center shadow-sm p-3 rounded-4 border-0">
                <h6 class="text-muted">Speed</h6>
                <h4 class="fw-bold">0 km/h</h4>
              </div>
            </div>
            <div class="col-md-4 mb-3">
              <div class="card text-center shadow-sm p-3 rounded-4 border-0">
                <h6 class="text-muted">Time Elapsed</h6>
                <h4 class="fw-bold">0 min</h4>
              </div>
            </div>
            <div class="col-md-4 mb-3">
              <div class="card text-center shadow-sm p-3 rounded-4 border-0">
                <h6 class="text-muted">Calories Burned</h6>
                <h4 class="fw-bold">0 kcal</h4>
              </div>
            </div>
          </div>
          </div>


        <!-- End of Main Section -->
      </div>
    </div>
  </div>

  <!-- Scripts -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
  <script>
        const toggleBtn = document.getElementById("sidebarToggle");
    const sidebar = document.getElementById("sidebar");

    toggleBtn.addEventListener("click", () => {
      sidebar.classList.toggle("show");
    });

    const apiKey = '79dee37f84fc7c'; 
    const url = `https://ipinfo.io?token=${apiKey}`;

    fetch(url)
      .then(response => response.json())
      .then(data => {
        const location = data.loc.split(',');
        const latitude = location[0];
        const longitude = location[1];


        const map = L.map('map').setView([latitude, longitude], 13);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
          attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        L.marker([latitude, longitude]).addTo(map)
          .bindPopup("<b>Your Location!</b>")
          .openPopup();
      });

  </script>
</body>
</html>
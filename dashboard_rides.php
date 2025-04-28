<?php
session_start();
require_once "member_guard.php";
require_once "classes/Member.php";
require_once "classes/Rental.php";

$id = $_SESSION["member_id"];
$member = new Member();
$details = $member->get_member($id);
$state_lagos =1;
$rental = new Rental();
$lgas = $rental -> fetch_lga($state_lagos);
$activeRide = $rental->hasActiveRide($id);

$availableBicycles = $rental->getAvailableBicycles(); 
$stations = $rental->getAllStations(); 

// $rental = new Rental();
// $activeRide = $rental->getActiveRide($id);

// echo "<pre>";
//    print_r($activeRide);
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
    .animated-bike-container {
  position: absolute;
  bottom: 10px;
  right: 10px;
  pointer-events: none;
}

.animated-bike {
  font-size: 2rem;
  color: white;
  animation: pedalMove 3s infinite ease-in-out;
  opacity: 0.8;
}

@keyframes pedalMove {
  0%, 100% {
    transform: translateX(0) rotate(0deg);
  }
  50% {
    transform: translateX(-10px) rotate(-10deg);
  }
}
  .ride-status-card {
  background: linear-gradient(135deg, #6290C8, #9D5C63);
  border-radius: 1.5rem;
  backdrop-filter: blur(10px);
  color: white;
  box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
  transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.ride-status-card:hover {
  transform: translateY(-4px);
  box-shadow: 0 14px 35px rgba(0, 0, 0, 0.25);
}

.ride-info p {
  font-size: 1rem;
  margin-bottom: 0.5rem;
}

.ride-progress-bar {
  height: 10px;
  border-radius: 10px;
  overflow: hidden;
  background-color: rgba(255, 255, 255, 0.3);
}

.badge {
  font-size: 0.9rem;
  border-radius: 1rem;
}
    .form-container {
      background: #ffffff;
      border-radius: 12px;
      padding: 2rem;
      box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
      transition: all 0.3s ease;
      font-weight: 100;
      /* height:570px; */
    }

    .form-container:hover {
      transform: scale(1.02);
      box-shadow: 0 15px 30px rgba(0, 0, 0, 0.2);
    }

    .form-group {
      margin-bottom: 20px;
    }

    .form-label {
      font-weight: 600;
      color: #333;
      display: flex;
      align-items: center;
      font-size: 1.1rem;
    }

    .form-control {
      width: 100%;
      padding: 12px;
      border: 1px solid #ccc;
      border-radius: 8px;
      font-size: 1rem;
      transition: border 0.3s ease;
    }

    .form-control:focus {
      border-color: #6290C8;
      box-shadow: 0 0 5px rgba(98, 144, 200, 0.5);
    }

    button {
      cursor: pointer;
      text-transform: uppercase;
    }

    .btn-gradient {
  background: linear-gradient(135deg, #4CAF50, rgba(98, 144, 200, 0.5));
  color: white;
  border: none;
  font-size: 1.2rem;
  padding: 15px 30px;
  border-radius: 8px;
  transition: all 0.3s ease;
}



.btn-gradient:hover {
  background: linear-gradient(135deg, #4CAF50, rgba(98, 144, 200, 0.7));
  transform: scale(1.05);
}

.btn-gradient:focus {
  outline: none;
}

    button i {
      font-size: 1.3rem;
    }


    @keyframes fadeInUp {
      0% {
        opacity: 0;
        transform: translateY(30px);
      }
      100% {
        opacity: 1;
        transform: translateY(0);
      }
    }


    .form-container {
      animation: fadeInUp 1s ease-out;
    }


    .btn-end-ride {
  background: linear-gradient(135deg, #FF4D4D, rgba(98, 144, 200, 0.5));
  color: white;
  border: none;
  font-size: 1.2rem;
  padding: 12px 25px; 
  border-radius: 8px;
  transition: all 0.3s ease;
}

.btn-end-ride:hover {
  background: linear-gradient(135deg, #FF4D4D, rgba(98, 144, 200, 0.7));
  transform: scale(1.05);
}

.btn-end-ride:focus {
  outline: none;
}

.alert {
        animation: fadeIn 0.5s ease-in-out;
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }

        /* Animations */
        @keyframes slideIn {
      0% { transform: translateY(40px); opacity: 0; }
      100% { transform: translateY(0); opacity: 1; }
    }

    @keyframes pulseGlow {
      0% { box-shadow: 0 0 0 0 rgba(98, 144, 200, 0.7); }
      70% { box-shadow: 0 0 0 15px rgba(98, 144, 200, 0); }
      100% { box-shadow: 0 0 0 0 rgba(98, 144, 200, 0); }
    }

    .animated-card {
      animation: slideIn 0.8s ease-out;
    }

    .countdown-timer {
      animation: pulseGlow 2s infinite;
    }

    .fun-icon {
      width: 90px;
      animation: bounce 2s infinite;
    }

    @keyframes bounce {
      0%, 100% { transform: translateY(0); }
      50% { transform: translateY(-5px); }
    }

    .btn-end-ride {
  background-color: #9D5C63;
  color: #fff;
  border: none;
  transition: background-color 0.3s ease;
}

.btn-end-ride:hover {
  background-color: #7c4349;
}

.end-ride-card {
  background-color: #F7F7F2;
  border-left: 6px solid #6290C8;
  padding: 2rem;
  border-radius: 1.5rem;
  box-shadow: 0 6px 16px rgba(0, 0, 0, 0.05);
}

.card-title {
  color: #032B43;
  font-weight: 600;
}

.card-label {
  color: #073B4C;
  font-weight: 500;
}

.card-select {
  border-radius: 0.5rem;
  padding: 0.6rem;
  font-size: 1rem;
}

.end-ride-btn {
  background: linear-gradient(90deg, #6290C8, #9D5C63);
  color: #fff;
  border: none;
  padding: 0.75rem 2rem;
  font-size: 1.1rem;
  border-radius: 0.75rem;
  transition: background 0.3s ease;
}

.end-ride-btn:hover {
  background: linear-gradient(90deg, #537bbd, #864852);
  box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
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
      <a href="dashboard_rides.php" class="sidebar-link active"><i class="fas fa-bicycle me-2"></i> Active Rides</a>
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
          <div class="nav-subtext fw-bold">Let's peddle </div>
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

    <div class="row d-flex justify-content-center align-items-start">
    <!-- Active Ride Section -->

    
      <?php
        if ($activeRide && $activeRide["ride_status"] != "pending"){
      ?>
<div class="col-md-5 mt-5 pt-5 me-2">
  <div class="ride-status-card p-4 shadow-lg rounded-4">
    <div class="d-flex align-items-center justify-content-between mb-3">
      <h4 class="fw-semibold text-white mb-0">
        <i class="fas fa-bicycle me-2"></i> Ride In Progress
      </h4>
      <span class="badge bg-light text-dark px-3 py-1">Active</span>
    </div>

    <div class="ride-info text-white mb-3">
      <p class="mb-2"><strong>Bicycle ID:</strong> <?= $activeRide["bicycle_id"] ?></p>
      <p class="mb-2"><strong>Start Station:</strong> <?= $activeRide["start_station_name"] ?? "Station" ?></p>
      <p class="mb-2"><strong>Start Time:</strong> <?= date("h:i A", strtotime($activeRide["start_time"])) ?></p>
    </div>
    <div class="animated-bike-container">
      <i class="fas fa-bicycle animated-bike"></i>
    </div>
    <div>
      <div class="progress mb-2 ride-progress-bar">
        <div class="progress-bar progress-bar-striped progress-bar-animated bg-light" style="width: 100%"></div>
      </div>
      <p class="text-light-emphasis mb-0"><small><i class="fas fa-clock me-1"></i> Ride is ongoing...</small></p>
    </div>

    
  </div>
</div>

        <div class="col-md-4 p-4 mt-5 pt-5 me-4">
  <div class="end-ride-card">
    


    <form method="POST" action="process/end_trip.php">

      <!-- Start Station Dropdown -->
      <div class="mb-4">
        <label for="start_station_id" class="form-label card-label">
          <i class="fas fa-map-marker-alt me-2"></i> Select End Station
        </label>
        <select name="start_station_id" id="start_station_id" class="form-control card-select" required>
          <option value="">Select Station</option>
          <?php foreach ($stations as $station): ?>
            <option value="<?= $station['station_id']; ?>"><?= $station['station_name']; ?></option>
          <?php endforeach; ?>
        </select>
      </div>

      <!-- Hidden Rental ID -->
      <input type="hidden" name="rental_id" value="<?= $activeRide['rental_id'] ?>">

      <!-- End Ride Button -->
       <!-- <div class="text-end"> -->
      <button type="submit" class="btn end-ride-btn">
        <i class="fas fa-stop me-2"></i> End Ride
      </button>
      <!-- </div> -->

    </form>

  </div>
</div>

    <?php }elseif($activeRide && $activeRide["ride_status"] == "pending"){ ?>
      <div class="col-md-6 mx-auto mt-5">
        <div class="card shadow-lg p-4 rounded-4 border-0 text-center animated-card"
         style="background: linear-gradient(135deg, #F7F7F2, #6290C8); color: #032B43;">
        <div class="mb-3">
        <img src="https://cdn-icons-png.flaticon.com/512/3113/3113479.png" alt="Pending Bicycle" class="fun-icon">
      </div>
      <h4 class="fw-bold mb-2">Hang Tight! </h4>
      <p class="mb-3">Your bicycle request is <strong>pending approval</strong>.</p>
      <p class="small fst-italic">The admin is checking the tire pressure and polishing the bell 🔔</p>

      <div class="mt-4">
        <div class="spinner-border text-primary" role="status">
          <span class="visually-hidden">Waiting...</span>
        </div>
        <p class="mt-2"><small>Estimated wait time:</small></p>
        <h5 class="fw-bold countdown-timer" id="countdown" style="letter-spacing: 1px;">00:10</h5>
      </div>
    </div>
  </div>
    <?php } ?>
    <!--End Active Ride Section -->

    </div>






    <div class="row d-flex justify-content-center align-items-start">
<!-- Start Ride Form -->
       <?php if(!($activeRide)): ?>
      <div class="col-md-5 mt-5">
        <form id="rentForm" method="POST" action="process/rental_process.php" class="form-container">

<!-- LGA Select -->
          <div class="form-group mt-4">
            <label for="lga" class="form-label">
            <i class="fas fa-landmark me-2"></i> Select Local Government:
            </label>
            <select name="lga" id="lga" class="form-control" required>
              <option value="">Select Local Government</option>
              <?php foreach ($lgas as $lga): ?>
                <option value="<?= $lga["lga_id"] ?>"><?= $lga["lga_name"] ?></option>
              <?php endforeach; ?>
            </select>
          </div>

<!-- Station Select -->
          <div class="form-group mt-4" id="dynamicFields">
          </div>
        </form>
      </div>
<!-- End Start Ride Form -->
      <?php endif; ?>       

    </div>


    
    <!-- End of Main Section -->
  </div>
</div>
<!-- End of Main Section -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="jquerymin.js"></script>
<script src="bootstrap/js/bootstrap.bundle.js" type="text/javascript"></script>
<script>
  $(document).ready(function () {
  $('#lga').change(function () {
    var lgaId = $(this).val();
    if (lgaId) {
      $.ajax({
        url: 'process/ajax/load_stations_and_bicycles.php',
        method: 'POST',
        data: { lga_id: lgaId },
        success: function (response) {
          $('#dynamicFields').html(response);
        }
      });
    } else {
      $('#dynamicFields').html('');
    }
  });

  $('#dynamicFields').on('change', '#start_station_id', function () {
    var stationId = $(this).val();
    if (stationId) {
      $.ajax({
        url: 'process/ajax/load_bicycles.php',
        method: 'POST',
        data: { station_id: stationId },
        success: function (response) {
          $('#bicycleField').html(response);
          $('#bicycleField').show();  // Make sure the bicycle field is shown
        }
      });
    } else {
      $('#bicycleField').html('');
      $('#bicycleField').hide();  // Hide the bicycle field if no station is selected
    }
  });
});


    var timeLeft = 10; // seconds
    const countdownElement = document.getElementById("countdown");

    const countdown = setInterval(() => {
      var minutes = Math.floor(timeLeft / 10);
      var seconds = timeLeft % 10;

      countdownElement.textContent =
        `${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;

      timeLeft--;

      if (timeLeft < 0) {
        clearInterval(countdown);
        countdownElement.textContent = "Refreshing...";
        setTimeout(() => {
          location.reload();
        }, 1000);
      }
    }, 1000);

</script>
<?php
require_once "partials/mem_dash_footer.php";

?>

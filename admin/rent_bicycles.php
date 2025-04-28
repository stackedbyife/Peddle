<?php

require_once "admin_guard.php";
require_once "classes/Admin.php";
require_once "classes/Bicycle.php";
require_once "classes/Station.php";

$admin = new Admin();
$total_members = $admin -> count_members();
$total_ride = $admin -> count_rides();

$admin1 = new Admin();
$admin2 = new Admin();
$station = new Bicycle();
$renting = new Station();

$rentals = $renting -> fetch_rent();

// echo "<pre>";
//     print_r($rentals);
// echo "</pre>";

$admin_bicycles = $admin1->fetch_bicycle();
$admin_users = $admin2->fetch_users();
// $admin_stations = $station->fetch_stations();

// Ensure data is in array format, even if it's a single item
// if (!is_array($admin_bicycles)) {
//     $admin_bicycles = [];
// } elseif (isset($admin_bicycles["bicycle_id"])) {
//     $admin_bicycles = [$admin_bicycles];
// }

// if (!is_array($admin_users)) {
//     $admin_users = [];
// } elseif (isset($admin_users["member_id"])) {
//     $admin_users = [$admin_users];
// }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/admin_css.css">
    <title>Peddle Admin Dashboard</title>
    <style>
        .modal-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            justify-content: center;
            align-items: center;
        }
        .form-container {
            background: white;
            padding: 20px;
            width: 400px;
            border-radius: 10px;
            text-align: center;
            position: relative;
            box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
        }
        .close-btn {
            position: absolute;
            top: 10px;
            right: 15px;
            background: none;
            border: none;
            font-size: 18px;
            cursor: pointer;
            color: #073B4C;
        }
        .form-container input[type="text"], .form-container input[type="number"], select {
            width: 90%;
            padding: 10px;
            margin: 8px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }
        .form-container select {
            background-color: #f7f7f7;
            color: #1A1A1A;
            cursor: pointer;
        }
        .btn {
            background: #073B4C;
            color: white;
            padding: 10px 15px;
            border: none;
            cursor: pointer;
            width: 100%;
            border-radius: 5px;
            font-size: 16px;
            transition: 0.3s;
        }
        .btn:hover {
            background: #5176A3;
            transform: scale(1.05);
        }
        .btn.delete {
            background: #388E3C;
            width: 75px;
        }
        .btn.delete:hover {
            background: #388E3C;
        }
        .btn.edit {
            background: #D32F2F;
        }
        .btn.edit:hover {
            background: #D32F2F;
        }
        .btn.detail {
            background: #388E3C;
        }
        .btn.detail:hover {
            background: #2E7D32;
        }
        .btn1 {
    background-color: #222222;
    color: white;
    border: none;
    padding: 8px 12px;
    border-radius: 5px;
    cursor: pointer;
    font-size: 14px;
}

.btn1:hover {
    background-color: #5176A3;
}
   </style>
</head>
<body>
    <div class="container">
        <!-- Sidebar -->
        <aside class="sidebar">
            <div class="menu-item">
                <a href="admin.php"> 
                    <img class="icon" src="../icons/dashboard.png" alt="Dashboard Icon">
                    <span>Dashboard</span>
                </a>
            </div>
            <div class="menu-item">
                <a href="admin_users.php">
                    <img class="icon" src="../icons/man.png" alt="Users Icon">
                    <span>Users</span>
                </a>
            </div>
            <div class="menu-item">
                <a href="admin_bicycles.php" >
                    <img class="icon" src="../icons/bicycle.png" alt="Bicycle Icon">
                    <span>Bikes</span>
                </a>
            </div>
            <div class="menu-item">
                <a href="admin_station.php">
                    <img class="icon" src="../icons/bike.png" alt="Bike Icon">
                    <span>Station</span>
                </a>
            </div>
            <div class="menu-item">
            <a href="rent_bicycles.php" class="active">
                <img class="icon" src="../icons/rent.png" alt="Help Icon">
                <span>Renting</span>
            </a>
            </div>
        </aside>
        
        <!-- Main Content -->
        <main class="main-content">
            <!-- Header -->
            <header class="header">
                <h1 class="card-title fw-bold text-center p-2"><a href="../index.html" class="home">Peddle HQ</a></h1>
                <div class="search-bar">
                    <input class="search" type="text" placeholder="Search..." />
                </div>
                <div class="user-actions">
                    <div class="user-icon">
                        <img class="icon" src="../icons/unauthorized-person.png" alt="admin icon">
                    </div>
                    <form action="admin_logout.php">
                        <button class="btn1">Logout</button>
                    </form>
                </div>
            </header>
            
            <!-- Dashboard Overview -->
            <section class="section">
                <div class="card">
                <h2>Total Rides</h2>
                <p><?php echo $total_ride["total_rides"] ; ?></p>
                </div>
                <div class="card">
                    <h2>Active Users</h2>
                    <p><?php echo $total_members["total_members"] ; ?></p>
                </div>
                <div class="card">
                    <h2>Revenue</h2>
                    <p>&#8358; 0</p>
                </div>
            </section>

            <!-- Renting Inventory Table -->
            <section>
                <div class="table-container">
                    <h2 style="text-align: center; margin-top:-10px;"> Renting List</h2>
                    <table>
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Renter's Name</th>
                                <th>Bicycle Number</th>
                                <th>Bicycle Status</th>
                                <th>Station Name</th>
                                <th>Local Government</th>
                                <th>Ride Status</th>
                                <th colspan="3" id="action">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                            $sn = 1;
                            foreach ($rentals as $rental ) {
                        ?>
                            <tr>
                                <td><?php echo $sn++; ?></td>
                                <td><?php echo htmlspecialchars($rental["renter_name"]); ?></td>
                                <td><?php echo htmlspecialchars($rental["bicycle_number"]); ?></td>
                                <td><?php echo htmlspecialchars($rental["bicycle_status"]); ?></td>
                                <td><?php echo htmlspecialchars($rental["station_name"]); ?> </td>
                                <td><?php echo htmlspecialchars($rental["lga_name"]); ?></td>
                                <td><?php echo htmlspecialchars($rental["ride_status"]); ?></td>
                                <form method="post">
                                    <td>
                                        <?php if($rental["ride_status"] == "pending") { ?>
                                            <button class="btn start-btn" data-bicycle-id="<?php echo $rental['bicycle_id']; ?>">Approve</button>
                                        <?php } elseif($rental["ride_status"] == "completed") { ?>
                                            <button class="btn finalize-btn" data-bicycle-id="<?php echo $rental['bicycle_id']; ?>">Finalize</button>
                                        <?php } ?>
                                    </td>
                                </form>
                            </tr>
                        <?php
                            }
                        ?>
                        </tbody>
                    </table>
                </div>
            </section>
        </main>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="script/jquery.js"></script>
    <script>

  $(".start-btn").click(function() {
    var bicycle_id = $(this).data("bicycle-id"); 

    $.ajax({
        url: 'process/process_rent_bicycle.php', 
        type: 'POST',
        data: {
            action: 'approve',  
            bicycle_id: bicycle_id
        },
        success: function(response) {
            console.log(response);
            try {
                var data = JSON.parse(response); 
                alert(data.message); 
                location.reload(); 
            } catch (e) {
                alert('Error parsing response');
                console.error(e);
            }
        },
        error: function(xhr, status, error) {
            console.log("AJAX Error:", xhr); 
            console.log("Raw response:", xhr.responseText); 
            alert("There was an error with the request: " + error);
        }
    });
  });


  $(".finalize-btn").click(function() {
    var bicycle_id = $(this).data("bicycle-id");

    $.ajax({
        url: 'process/process_rent_bicycle.php', 
        type: 'POST',
        data: {
            action: 'complete', 
            bicycle_id: bicycle_id
        },
        success: function(response) {
            console.log(response); 
            try {
                var data = JSON.parse(response); 
                alert(data.message); 
                location.reload(); 
            } catch (e) {
                alert('Error parsing response');
                console.error(e);
            }
        },
        error: function(xhr, status, error) {
            console.log(xhr.responseText); 
            alert("There was an error with the request: " + error);
        }
    });
  });
</script>
</body>
</html>
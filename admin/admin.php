<?php

require_once "admin_guard.php";
require_once "classes/Admin.php";

$admin = new Admin();
$total_members = $admin -> count_members();
$total_ride = $admin -> count_rides();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/admin_css.css">
    <title>Peddle Admin Dashboard</title>
</head>
<body>
    <div class="container">
        <!-- Sidebar -->
        <aside class="sidebar">
            <div class="menu-item">
                <a href="admin.php" class="active"> 
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
                <a href="admin_bicycles.php">
                    <img class="icon" src="../icons/bicycle.png" alt="Bicycle Icon">
                    <span>Bikes</span>
                </a>
            </div>
            <div class="menu-item">
                <a href="admin_station.php">
                    <img class="icon" src="../icons/bike.png" alt="Station Icon">
                    <span>Station</span>
                </a>
            </div>
            <div class="menu-item">
            <a href="rent_bicycles.php">
                <img class="icon" src="../icons/rent.png" alt="Help Icon">
                <span>Renting</span>
            </a>
            </div>
        </aside>
        
        <!-- Main Content -->
        <main class="main-content">
            <!-- Header -->
            <header class="header">
                <h1 class="card-title fw-bold text-center p-2">
                    <a href="../index.php" class="home">Peddle HQ</a>
                </h1>
                <div class="search-bar">
                    <input class="search" type="text" placeholder="Search..." />
                </div>
                <div class="user-actions">
                    <div class="user-icon">
                        <img class="icon" src="../icons/unauthorized-person.png" alt="Admin Icon">
                    </div>
                    <form action="admin_logout.php" method="post">
                        <button class="btn">Logout</button>
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
                    <p><strong><?php echo $total_members["total_members"] ; ?></strong></p>
                </div>
                <div class="card">
                    <h2>Revenue</h2>
                    <p>&#8358; 0</p>
                </div>
            </section>

            <!-- Feedback Message -->
            <?php if (isset($_SESSION["adminfeedback"])): ?>
                <div class="custom-alert2 feedback-alert">
                    <span class="success-icon">✔️</span>
                    <span class="feedback-message">
                        <?= $_SESSION["adminfeedback"] ?>
                    </span>
                    <button class="close-btn" onclick="this.parentElement.style.display='none'">&times;</button>
                </div>
                <?php unset($_SESSION["adminfeedback"]); ?>
            <?php endif; ?>

            <!-- Stats & Chart Section -->
            <section class="section">
                <div class="card">
                    <h2>Overview</h2>
                    <div class="chart-placeholder"></div>
                </div>
                <div class="card">
                    <h2>Top Locations</h2>
                    <div class="chart-placeholder"></div>
                </div>
            </section>
        </main>
    </div>
</body>
</html>
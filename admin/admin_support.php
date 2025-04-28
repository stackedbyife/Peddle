<?php

require_once "admin_guard.php";


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css"  href="css/admin_css.css">
    <title>Peddle Admin Dashboard</title>
   
</head>
<body>
    <div class="container">
        <!-- Sidebar -->
        <aside class="sidebar">
            <div class="menu-item">
            <a href="admin.php" > 
                <img class="icon" src="../icons/dashboard.png" alt="Dashboard Icon">
                <span>Dashboard</span>
            </a>
            </div>
            <div class="menu-item">
            <a href="admin_users.php" >
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
            <a href="admin_station.php" >
                <img class="icon" src="../icons/bike.png" alt="Bike Icon">
                <span>Station</span>
            </a>
            </div>
            <div class="menu-item">
            <a href="admin_support.php" class="active">
                <img class="icon" src="../icons/help-desk (1).png" alt="Help Icon">
                <span>Support</span>
            </a>
            </div>
        </aside>
        
        <!-- Main Content -->
        <main class="main-content">
            <!-- Header -->
            <header class="header">
                <h1 class="card-title fw-bold text-center  p-2"><a href="../index.html" class="home" >Peddle HQ</a></h1>
                <div class="search-bar">
                    <input class="search" type="text" placeholder="Search..." />
                </div>
                <div class="user-actions">
                    <div class="user-icon">
                        <img class="icon" src="../icons/unauthorized-person.png" alt="admin icon">
                    </div>
                    <form action="admin_logout.php">
                    <button class="btn">Logout</button>
                    </form>
                </div>
            </header>
            
            <!-- Dashboard Overview -->
            <section class="section">
                <div class="card">
                    <h2>Total Rides</h2>
                    <p>15</p>
                </div>
                <div class="card">
                    <h2>Active Users</h2>
                    <p>150</p>
                </div>
                <div class="card">
                    <h2>Revenue</h2>
                    <p>&#8358; 200,000</p>
                </div>
            </section>
            <h2 style="text-align: center;">Coming Soon....</h2>
            <section>

            </section>
            

        </main>
    </div>
</body>
</html>

<?php

require_once "admin_guard.php";
require_once "classes/Admin.php";

$admin = new Admin();
$total_members = $admin -> count_members();
$total_ride = $admin -> count_rides();
$admin1 = new Admin;
$admins = $admin1->fetch_users();

// echo "<pre>";
// print_r($admins);
// echo "<pre>";



if (!is_array($admins)) {
    $admins = [];
} elseif (isset($admins["member_id"])) {

    $admins = [$admins];
}
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
                <a href="admin.php">
                    <img class="icon" src="../icons/dashboard.png" alt="Dashboard Icon">
                    <span>Dashboard</span>
                </a>
            </div>
            <div class="menu-item">
                <a href="admin_users.php" class="active">
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
                    <img class="icon" src="../icons/bike.png" alt="Bike Icon">
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
                <h1 class="card-title fw-bold text-center p-2"><a href="../index.html" class="home">Peddle HQ</a></h1>
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
            
            <section>
                <div class="table-container">
                    <h2 style="text-align: center; margin-top:-10px;">Registered Members</h2>
                    <table>
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone Number</th>
                                <th colspan="3" id="action">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $sn = 1; ?>
                            <?php
                             foreach ($admins as $admin){    
                            ?>
                            <tr>
                                <td><?php echo $sn++; ?></td>
                                <td><?php echo htmlspecialchars($admin["first_name"] . ' ' . $admin["last_name"]); ?></td>
                                <td><?php echo htmlspecialchars($admin["email"]); ?></td>
                                <td><?php echo htmlspecialchars($admin["phone_number"] ?? "N/A"); ?></td>
                                
                                <td><button class="btn delete btndelete" value="<?php echo $admin["member_id"]; ?>">Delete</button></td>
                                <td><button class="btn edit">Edit</button></td>
                                <td><a class="btn detail" href="#">Detail</a></td>
                                
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

    <script src="script/jquery.js"></script>
    <script>
        $(function(){

//Begining 
            $(".btndelete").click(function(event){
                event.preventDefault();
                var userid = $(this) .val();

                $.ajax({
                    url:"process/process_member_delete.php",
                    method: "POST",
                    data: { userid:userid},
                    dataType: "json",
                    success:function(response){
                        if(response.status === "success"){
                            alert(response.message);
                            setTimeout(function(){
                                location.reload();
                            },1000);
                        }else{
                            alert(response.message);
                        }
                    },
                    error: function(errormsg){
                        console.log(errormsg);
                    }
                });
            });

//End
        })
    </script>
</body>
</html>

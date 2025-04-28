<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once "admin_guard.php";
require_once "classes/Admin.php";
require_once "classes/Bicycle.php";

$admin = new Admin();
$total_members = $admin -> count_members();
$total_ride = $admin -> count_rides();

$admin1 = new Admin();
$admin2 = new Admin();
$station = new Bicycle();
$admin_bicycles = $admin1->fetch_bicycle();
$admin_users = $admin2->fetch_users();


$admin_stations = $station ->fetch_stations();
// echo "<pre>";
//     print_r($admin_bicycles);
// echo "</pre>";

if (!is_array($admin_bicycles)) {
    $admin_bicycles = [];
} elseif (isset($admin_bicycles["bicycle_id"])) {
    $admin_bicycles = [$admin_bicycles];
}



if (!is_array($admin_users)) {
    $admin_users = [];
} elseif (isset($admin_users["member_id"])) {
    $admin_users = [$admin_users];
}
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


        .form-container input[type="text"] {
            width: 90%;
            padding: 10px;
            margin: 8px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }
        .form-container input[type="number"] {
            width: 90%;
            padding: 10px;
            margin: 8px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }

        .radio-group {
            display: flex;
            flex-direction: column;
            gap: 10px;
            margin: 15px 0;
        }

        .radio-group label {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 16px;
            cursor: pointer;
            color: #073B4C;
        }

        .radio-group input[type="radio"] {
            accent-color: #073B4C;
            width: 16px;
            height: 16px;
            margin-bottom:20px;
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
        }

        .btn:hover {
            background: #5176A3;
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


.btn:hover {
    background: #5176A3;
    transform: scale(1.05);
}

.btn.delete {
    background: #D32F2F;
}

.btn.delete:hover {
    background: #B71C1C;
}

.btn.edit {
    background: #FFA000;
}

.btn.edit:hover {
    background: #FF8F00;
}

.btn.detail {
    background: #388E3C;
}

.btn.detail:hover {
    background: #2E7D32;
}
select {
            width: 95%;
            padding: 10px;
            margin: 8px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
            background-color: #f7f7f7;
            color:#1A1A1A;
            cursor:pointer;
        }

        select:focus {
            outline: none;
            border-color: #073B4C;
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
            <a href="admin_bicycles.php" class="active">
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
                    <!-- Button to Open Form -->
                     <p>Add Bicycles</p>
                     <button type="button" class="btn" onclick="openForm()">Add New Bicycle</button>
                </div>
                <div class="card">
                <h2>Active Users</h2>
                <p><?php echo $total_members["total_members"] ; ?></p>
                </div>
            </section>

            <!-- Form Modal -->
            <div class="modal-overlay" id="modal">
                <div class="form-container">
                    <button class="close-btn" onclick="closeForm()">&times;</button>
                    <h2>Add New Bicycle</h2>
                    <form id="bicycleForm">
                        <input type="text" name="bicycle" id="bicycle_number" placeholder="Enter Bicycle Number" required> <br>

                        <select name="station" id="station_id" required>
                            <option value="">Select Station</option>
                            <?php foreach($admin_stations as $station) { ?>
                                <option value="<?php echo $station["station_id"]; ?>"><?php echo $station["station_name"]; ?></option>
                            <?php } ?>
                        </select>

                        <div class="radio-group">
                            <label for="available">
                                <input type="radio" id="available" name="status" value="Available" required>
                                Available
                            </label>
                            
                            <label for="in-use">
                                <input type="radio" id="in-use" name="status" value="In_Use" required>
                                In Use
                            </label>
                            
                            <label for="reserved">
                                <input type="radio" id="reserved" name="status" value="Reserved" required>
                                Reserved
                            </label>
                            
                            <label for="maintenance">
                                <input type="radio" id="maintenance" name="status" value="Maintenance" required>
                                Maintenance
                            </label>
                        </div>

                        <button name="btn_bicycle" id="btn_bicycle" type="submit" class="btn">Submit</button>
                    </form>
                </div>
            </div>

            <section>
                <div class="table-container">
                <h2 style="text-align: center; margin-top:-10px;"> Bicycle Inventory</h2>
                    <table>
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Bicycle Number</th>
                                <!-- <th>Station ID</th> -->
                                <th>Station Name</th>
                                <th>Local Government</th>
                                <th>Bicycle Status</th>
                                <th colspan="3" id="action">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                               $sn = 1;
                               foreach ($admin_bicycles as $admin_bicycle ) {
                               
                            ?>
                            <tr>
                                <td><?php echo $sn++; ?></td>
                                <td><?php echo htmlspecialchars($admin_bicycle["bicycle_number"]); ?></td>
                                <td><?php echo htmlspecialchars($admin_bicycle["station_name"]); ?></td>
                                <td><?php echo htmlspecialchars($admin_bicycle["lga_name"]); ?></td>
                                <td><?php echo htmlspecialchars($admin_bicycle["bicycle_status"]); ?> </td>
                                <form method="post">
                                <td><button class="btn delete btndelete" name="btndelete" value="<?php echo $admin_bicycle['bicycle_id']; ?>" >Delete</button></td>
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

    function openForm() {
        document.getElementById("modal").style.display = "flex";
    }


    function closeForm() {
        document.getElementById("modal").style.display = "none";
    }

    $(function() {

        $("#btn_bicycle").click(function(event) {
            event.preventDefault();

           
            $("#btn_bicycle").prop('disabled', true);

            var bike = $("#bicycle_number").val();
            var station_id = $("#station_id").val();
            var status = $("input[name='status']:checked").val();

            if (!station_id || !status || !bike) {
                alert("Please fill in all fields.");
                $("#btn_bicycle").prop('disabled', false);
                return;
            }

            console.log("Sending:", {
                bicycle: bike,
                station: station_id,
                status: status
            });

        
            $.ajax({
                url: 'process/process_bicycle.php',
                type: 'POST',
                data: {
                    bicycle: bike,
                    station: station_id,
                    status: status
                },
                dataType: 'json',
                success: function(response) {
                    console.log("Success:", response);
                    if (response.status === 'success') {
                        alert(response.message);
                        location.reload(); 
                    } else {
                        alert(response.message);
                    }
              
                    $("#btn_bicycle").prop('disabled', false);
                },
                error: function(xhr, status, error) {
                    console.error("Error response:", xhr.responseText);
                    console.error("Status:", status);
                    console.error("Error thrown:", error);
                    alert("Something went wrong. Check console for details.");
                
                    $("#btn_bicycle").prop('disabled', false);
                }
            });
        });

        
        $("form").submit(function(event) {
            event.preventDefault();
        });

        // Delete Bicycle
        $(".btndelete").click(function(event) {
            event.preventDefault();
            var bicycleId = $(this).val();

            if (confirm("Are you sure you want to delete this bicycle?")) {
                $.ajax({
                    url: "process/process_btndelete.php",
                    method: "POST",
                    data: { btndelete1: bicycleId },
                    dataType: "json",
                    success: function(response) {
                        if (response.status === "success") {
                            alert(response.message || "Bicycle deleted successfully!");
                            setTimeout(function() {
                                location.reload(); 
                            }, 1000);
                        } else {
                            alert(response.message || "An error occurred.");
                        }
                    },
                    error: function(xhr, status, error) {
    console.error("Error deleting bicycle:");
    console.error("XHR Object:", xhr);  
    console.error("Status:", status);   
    console.error("Error Thrown:", error);  


    if (xhr.responseText) {
        console.error("Response Text:", xhr.responseText);
    }

    alert("An error occurred while deleting the bicycle.");
}
                });
            }
        });
    });
</script>
</body>
</html>
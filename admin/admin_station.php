<?php
require_once "admin_guard.php";
require_once "classes/Station.php";
require_once "classes/Admin.php";

$admin = new Admin();
$total_members = $admin -> count_members();
$total_ride = $admin -> count_rides();
$station1 = new Station();
$admin_station = $station1 ->fetch_station();
$states = $station1->fetch_lga(1);
// echo "<pre>";
// print_r( $states);
// echo "</pre>"
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/admin_css.css">
    <title>Peddle Admin Dashboard</title>

    <style>
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

        .form-container input, .form-container select {
            width: 90%;
            padding: 10px;
            margin: 8px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
            background-color: #f7f7f7;
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
            width: 100%;
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
                <a href="admin_bicycles.php">
                    <img class="icon" src="../icons/bicycle.png" alt="Bicycle Icon">
                    <span>Bikes</span>
                </a>
            </div>
            <div class="menu-item">
                <a href="admin_station.php" class="active">
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
            <header class="header">
                <h1 class="card-title fw-bold text-center p-2">
                    <a href="../index.html" class="home">Peddle HQ</a>
                </h1>
                <div class="search-bar">
                    <input class="search" type="text" placeholder="Search...">
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

            <section class="section">
                <div class="card">
                <h2>Total Rides</h2>
                <p><?php echo $total_ride["total_rides"] ; ?></p>
                </div>
                <div class="card">
                    <p>Add Stations</p>
                    <button class="btn" onclick="openForm()">Add New Station</button>
                </div>
                <div class="card">
                    <h2>Active Users</h2>
                    <p><?php echo $total_members["total_members"] ; ?></p>
                </div>
            </section>

          <!-- Form Modal -->
          <div class="modal-overlay" id="modal">
            <div class="form-container">
                <h2>Add New Station</h2>
                <button class="close-btn" onclick="closeForm()">&times;</button>

                <form id="stationForm">
                    <input type="text" name="station_name" id="station_name" placeholder="Enter Station Name" required>

                    <select name="state" id="state" required>
                        <option value="">Select State</option>
                        <option value="1">Lagos</option>
                    </select>

                    <select name="local_government" id="local_government" required>
                        <option value="">Select Local Government</option>
                        <?php 
                            foreach($states as $state){
                        ?>
                        <option value="<?php echo $state["lga_id"] ?>"><?php echo $state["lga_name"] ?></option>
                        <?php } ?>
                    </select>

                    <input type="number" name="capacity" id="capacity" placeholder="Enter Capacity" required>

                    <button type="submit" class="btn" id="btn_station">Submit</button>
                </form>
            </div>
        </div>

        <section>
            <div class="table-contain">
                <h2 style="text-align: center; margin-top:-10px;"> Station Inventory</h2>
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Station Name</th>
                            
                            <th>Local Government</th>
                            <th>Capacity</th>
                            <th colspan="3" id="action">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sn = 1;
                        foreach ($admin_station as $station) {
                            ?>
                            <tr>
                                <td><?php echo $sn++; ?></td>
                                <td><?php echo htmlspecialchars($station["station_name"]); ?></td>
                                
                                <td><?php echo htmlspecialchars($station["lga_name"]);?></td>
                                <td><?php echo htmlspecialchars($station["capacity"]);?></td>
                                <td><button class="btn delete btndelete" name="btndelete" value="<?php echo $station["station_id"]; ?>">Delete</button></td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </section>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        function openForm() {
            document.getElementById("modal").style.display = "flex";
        }

        function closeForm() {
            document.getElementById("modal").style.display = "none";
        }

        $(function(){
            
            $(function(){
   
                $.ajax({
                    url: "process/get_states.php", 
                    method: "GET",
                    success: function(response){
                        var states = JSON.parse(response);
                        states.forEach(function(state){
                            $("#state").append(new Option(state.name, state.id));
                        });
                    },
                    error: function(err){
                        console.log(err);
                    }
                });

              
                $("#state").change(function(){
                    var stateId = $(this).val();
                    if (stateId) {
                        $.ajax({
                            url: "process/get_local_governments.php", 
                            method: "GET",
                            data: { state_id: stateId },
                            success: function(response){
                                var localGovernments = JSON.parse(response);
                                $("#local_government").empty().append('<option value="">Select Local Government</option>');
                                localGovernments.forEach(function(lga){
                                    $("#local_government").append(new Option(lga.name, lga.id));
                                });
                            },
                            error: function(err){
                                console.log(err);
                            }
                        });
                    }
                });

                // Submit form
                $("#btn_station").click(function(event){
                    event.preventDefault();

                    var name = $("#station_name").val();
                    var lga = $("#local_government").val();
                    var cap = $("#capacity").val();

                    $.ajax({
                        url: "process/process_station.php",
                        method: "POST",
                        data: { name, local_government: lga, capacity: cap },
                        success: function(response){
                            alert(response);
                            setTimeout(() => location.reload(), 1000);
                        },
                        error: function(err){
                            console.log(err);
                        }
                    });
                });
            });
            //End of code
        });

        $(document).ready(function () {
            $(document).on("click", ".btndelete", function () {
                const stationId = $(this).val();

                if (confirm("Are you sure you want to delete this station?")) {
                    $.ajax({
                        url: "process/process_st_btndelete.php",
                        type: "POST",
                        data: { stationid: stationId },
                        dataType: "json",
                        success: function (res) {
                            if (res.status === "success") {
                                alert(res.message);
                                location.reload();
                            } else {
                                alert(res.message);
                            }
                        },
                        error: function (xhr, status, error) {
                            console.log("AJAX Error:", error);
                            alert("Something went wrong!");
                        }
                    });
                }
            });
        });
    </script>
</body>
</html>
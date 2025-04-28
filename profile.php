<?php
session_start();
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
  <link rel="stylesheet" href="bootstrap/css/bootstrap.css" />
  <link rel="stylesheet" href="css/dashboard_css.css" />
  <title>Profile</title>
  <style>
    .go-back-btn {
    background-color: #073B4C;
    color: white;
    border: none;
    padding: 10px 16px;
    font-size: 14px;
    border-radius: 8px;
    cursor: pointer;
    transition: background 0.3s ease, transform 0.2s ease;
    display: inline-flex;
    align-items: center;
    gap: 8px;
}

.go-back-btn:hover {
    background-color: #5176A3;
    transform: translateX(-3px);
    box-shadow: 0 10px 20px rgba(0,0,0,0.2);
}
.edit{
    background-color: #073B4C;
    color: white;
    border: none;
    padding: 10px 16px;
    font-size: 14px;
    border-radius: 8px;
    cursor: pointer;
    transition: background 0.3s ease, transform 0.2s ease;
    display: inline-flex;
    align-items: center;
    gap: 8px;
}
.edit:hover{
    background-color: #5176A3;
    color:white;
    transform: translateX(-3px);
    box-shadow: 0 10px 20px rgba(0,0,0,0.2);
}
.edit_col{
    margin-left:120px;
}
  </style>
</head>
<body>
  <div class="container mt-5">
    <div class="row ">
    <div class="card shadow-lg p-4 rounded-4 border-0 mt-3">
      <div class="d-flex flex-column align-items-center text-center">
        <img src="images2/<?php echo $details["member_avatar"]; ?>.png" class="avatar-img mb-3" alt="User Avatar" style="width: 120px; height: 120px; border-radius: 50%;">
        <h4><?php echo $details["first_name"] . " " . $details["last_name"]; ?></h4>
        <p class="text-muted">Email: <?php echo $details["email"]; ?></p>
        <p class="text-muted ">Phone Number: <?php echo $details["phone_number"]; ?></p>
        
        <p class="text-muted">Membership: <?php echo $details["membership_type"];?><br> <span class="badge bg-success">Active</span></p>
        
        </div>
        <div class="row">
            <div class="col-md-4">
                <button class="go-back-btn" onclick="window.history.back()">← Go Back</button>
            </div>
            <div class=" col-md-6 edit_col">
        <a href="edit_profile.php" class="btn mt-3 edit" >Edit Profile</a>
            </div>
        </div>
      </div>
    </div>
  </div>
</body>
</html>

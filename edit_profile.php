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
  <link rel="stylesheet" href="bootstrap/css/bootstrap.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="css/dashboard_css.css">
  <title>Edit Profile</title>
  <style>
    body {
      transform: scale(0.9);
      transform-origin: top left; 
    }
    .card-custom {
      border-radius: 15px;
      padding: 30px;
      max-width: 600px;
      margin: auto;
      box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
    }
    .avatar-container {
      position: relative;
      display: inline-block;
    }
    .avatar-upload {
      position: absolute;
      bottom: 0;
      right: 0;
      background: rgba(0, 0, 0, 0.7);
      color: #fff;
      padding: 5px 10px;
      border-radius: 50%;
      cursor: pointer;
    }
    .form-label {
      font-weight: 500;
    }
    .membership_input{
        cursor: pointer;
    }
    .btnsave{
        background-color: #073B4C;
        color: white;
        border: none;
        padding: 10px 16px;
        font-size: 17px;
        border-radius: 8px;
        cursor: pointer;
        transition: background 0.3s ease, transform 0.2s ease;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }
    .btnsave:hover{
        background-color: #5176A3;
        color:white;
        transform: translateX(-3px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.2);
    }
    .btn-outline-secondary{
        padding: 10px 16px;
        font-size: 17px;
        border-radius: 8px;
        cursor: pointer;
        transition: background 0.3s ease, transform 0.2s ease;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }
    .btn-outline-secondary:hover{
        transform: translateX(-3px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.2);
    }
  </style>
</head>
<body>
<div class="container mt-5">
  <div class="card card-custom">
    <h3 class="text-center mb-4">Edit Profile</h3>
    <form action="process/update_profile.php" method="POST" enctype="multipart/form-data">
      <div class="text-center mb-4">
        <div class="avatar-container">
          <img src="images2/<?php echo $details["member_avatar"]; ?>.png" class="rounded-circle border" width="120" height="120" alt="Avatar">
          <label class="avatar-upload" title="Change Avatar">
            <i class="bi bi-camera"></i>
            <input type="file" name="avatar" class="d-none" accept="image/*">
          </label>
        </div>
      </div>
      <div class="mb-3">
        <label class="form-label">First Name</label>
        <input type="text" name="first_name" class="form-control form-control-lg" value="<?php echo $details["first_name"]; ?>" required>
      </div>
      <div class="mb-3">
        <label class="form-label">Last Name</label>
        <input type="text" name="last_name" class="form-control form-control-lg" value="<?php echo $details["last_name"]; ?>" required>
      </div>
      <div class="mb-3">
        <label class="form-label">Phone Number</label>
        <input type="tel" name="phone" class="form-control form-control-lg" value="<?php echo $details["phone_number"]; ?>" required>
      </div>
      <div class="mb-3">
        <label class="form-label">Membership</label>
        <select name="membership" class="form-select form-control-lg membership_input" required>
          <option value= 1 <?php if ($details["membership_type"] == 1) echo "selected"; ?>>Single Ride</option>
          <option value= 2 <?php if ($details["membership_type"] == 2) echo "selected"; ?>>Monthly</option>
          <option value= 3 <?php if ($details["membership_type"] == 3) echo "selected"; ?>>Annually</option>
        </select>
      </div>
      <div class="d-flex justify-content-between">
        <a href="dashboard.php" class="btn btn-outline-secondary btn-lg">Dashboard</a>
        <button type="submit" name="btnedit" class="btn btn-lg btnsave">Save Changes</button>
      </div>
    </form>
  </div>
</div>
<script src="bootstrap/js/bootstrap.bundle.js"></script>
</body>
</html>
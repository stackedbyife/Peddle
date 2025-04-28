<?php


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Select Your Peddle Avatar</title>
    <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="css/animate.min.css">
    <link rel="stylesheet" type="text/css"  href="css/avatar.css">
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">

</head>
<body>
    <div class="container">
            <h5 class="card-title fw-bold text-center mb-3"><a href="index.php" class="home" >Peddle</a></h5>
            <h2 class="mb-4 text-muted" style="color: #073B4C;">Select Your Peddle Avatar</h2>
        <form action="process/avatar_process.php" method="post">
            <div class="avatar-container"  >
                <input type="hidden" name="selected_avatar" id="selectedAvatarInput">
                <img data-value="cyborg" src="images2/cyborg.png" class="avatar"  onclick="selectAvatar(this)">
                <img data-value="girl" src="images2/girl.png" class="avatar" onclick="selectAvatar(this)">
                <img data-value="knight" src="images2/knight.png" class="avatar" onclick="selectAvatar(this)">
                <img data-value="bear" src="images2/bear.png" class="avatar" onclick="selectAvatar(this)">
                <img data-value="unicorn" src="images2/unicorn.png" class="avatar" onclick="selectAvatar(this)">
                <img data-value="fox" src="images2/fox.png" class="avatar" onclick="selectAvatar(this)">
                <img data-value="robot" src="images2/robot.png" class="avatar" onclick="selectAvatar(this)">
                <img data-value="curly" src="images2/curly.png" class="avatar" onclick="selectAvatar(this)">
                <img data-value="ai" src="images2/ai.png" class="avatar" onclick="selectAvatar(this)">
                <img data-value="bald" src="images2/bald.png" class="avatar" onclick="selectAvatar(this)">
                <img data-value="eagle" src="images2/eagle.png" class="avatar" onclick="selectAvatar(this)">
                <img data-value="rabbit" src="images2/rabbit.png" class="avatar" onclick="selectAvatar(this)">
                <img data-value="afro" src="images2/afro.png" class="avatar" onclick="selectAvatar(this)">
                <img data-value="bunny" src="images2/bunny.png" class="avatar" onclick="selectAvatar(this)">
                <img data-value="agent" src="images2/agent.png" class="avatar" onclick="selectAvatar(this)">
                <img data-value="ninja" src="images2/ninja.png" class="avatar" onclick="selectAvatar(this)">
            </div>
            <div class="mt-4 text-center">
                <button name="btnavatar" type="submit" class="btn avatar-button">Next</button>
            </div>
        </form>
    </div>

<script src="js/peddle.js"></script>
<script>
    document.querySelector('.avatar-button').disabled = true;
    function selectAvatar(selected) {
    document.querySelectorAll('.avatar').forEach(avatar => avatar.classList.remove('selected'));
    selected.classList.add('selected');
    document.querySelector('.avatar-button').disabled = false;

    var selectedAvatar = selected.getAttribute("data-value");
    document.getElementById("selectedAvatarInput").value = selectedAvatar;
}
</script>
</body>
</html>
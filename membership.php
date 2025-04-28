<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Peddle Membership</title>
    <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="css/animate.min.css">
    <link rel="stylesheet" type="text/css"  href="css/membership.css">
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
    <style>
       

    </style>
</head>
<body>
    <div class="background-overlay"></div>
    <div class="container">
        <div class="membership-card">
            <h1 class="card-title fw-bold text-center mb-4 p-2"><a href="index.php" class="home" >Peddle</a></h1>
            <p class="text-center text-muted">SELECT YOUR PLAN</p>

    <form action="process/membership_process.php" method="post" onsubmit="return submitPlan()">
            <input type="hidden" name="selected_plan" id="selectedPlan" value=1>

            <div class="plan-option active" onclick="selectPlan(this)" data-value=1>
                <div class="plan">
                    <h6 class="mb-2"><strong>Single Ride</strong></h6>
                    <span class="small text-muted"><img src="images2/flash.png" alt="flash icon">Paid per ride </span><br>
                    <span class="small text-muted"><img src="images2/flash.png" alt="flash icon">Includes maintenance & insurance</span>
                </div>
                <span class="price">&#8358;5,000<span class="price-month">/Trip</span></span>
            </div>

            <div class="plan-option" onclick="selectPlan(this)" data-value=2>
                <div class="plan">
                    <h6 class="mb-2"><strong>Monthly</strong></h6>
                    <span class="small text-muted"><img src="images2/flash.png" alt="flash icon">Paid monthly </span><br>
                    <span class="small text-muted"><img src="images2/flash.png" alt="flash icon">Includes maintenance & insurance</span>
                </div>
                <span class="price">&#8358;30,000<span class="price-month">/Month</span></span>
            </div>

            <div class="plan-option" onclick="selectPlan(this)" data-value=3>
                <div class="plan">
                    <h6 class="mb-2"><strong>Annually</strong></h6>
                    <span class="small text-muted"><img src="images2/flash.png" alt="flash icon">Paid yearly </span><br>
                    <span class="small text-muted"><img src="images2/flash.png" alt="flash icon">Includes maintenance & insurance</span>
                </div>
                <span class="price ">&#8358;100,000<span class="price-month">/Year</span></span>
            </div>

            <button class="next-btn mt-3">Next</button>
    </form>
        </div>
    </div>

    <script>
function selectPlan(element) {
    document.querySelectorAll('.plan-option').forEach(item => item.classList.remove('active'));
    element.classList.add('active');

    document.getElementById('selectedPlan').value = element.getAttribute('data-value');
}


    </script>
</body>
</html>

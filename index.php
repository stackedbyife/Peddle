<?php

session_start();

require_once "classes/Member.php";

$member = new Member();
// $member -> get_member();

    
// if (isset($_SESSION["member_id"])) {
//     echo "Logged-in Member ID: " . $_SESSION["member_id"];
// } else {
//     echo "No user is logged in.";
// }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css"  href="bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="swiper/css/swiper-bundle.min.css" />
    <link rel="stylesheet" type="text/css" href="css/animate.min.css">
    <link rel="stylesheet" type="text/css"  href="css/peddle.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&family=Poppins:wght@400;600;700&family=Pacifico&display=swap" rel="stylesheet">
    <title>Peddle- Home</title>
</head>
<body>
    <!-- Begining of NAV Bar	 -->    
<nav class="navbar navbar-expand-lg navbar-light bg-white shadow mt-3 ps-4 pt-3 sticky-top">
    <div class="container-fluid">
    <!-- Logoname -->
      <a class="navbar-brand ps-2" href="index.php" style="font-size:25px; font-weight: bold;">
        <img src="images/peddlelogo.png" alt="bicycle" id="peddle_logo">  Peddle</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" 
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
  <!-- Endoflogoname -->

    <div class="collapse navbar-collapse ms-auto justify-content-end" id="navbarSupportedContent">
        
        <ul class="navbar-nav mb-2 mb-lg-0 ms-auto d-flex gap-4 me-5">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="#home">Home</a>
          </li>
    

          
          <?php if(isset($_SESSION["member_id"])){  ?>  
        <li class="nav-item">
            <a class="nav-link" href="dashboard.php">Dashboard</a>
        </li>   
          <li class="nav-item">
            <a class="nav-link" href="member_logout.php">Log Out</a>
          </li>

          <?php }else{ ?>
<!-- User not online  -->
            <li class="nav-item">
                <a class="nav-link" href="login.php"> Login</a>
            </li> 
            <li class="nav-item">
                <a class="nav-link" href="registration.php">Join</a>
            </li>
          <?php } ?>
        </ul>  
     </div>
    </div>
</nav>

  <!-- End of NAV Bar -->

  <!-- Begining of the hero section -->
<section class="text-center py-5 " style="background-color: #F7F7F2;">
    <div class="container hero_section">
        <p class="lead text-secondary text-center fw-bold ">Peddle</p>
        <h1 class="fw-bold hero_header fs-1 fs-md-">Ride with Ease, Anytime, Anywhere!</h1>
        <p class="lead text-secondary">Rent a bike in seconds and enjoy hassle-free commuting.</p>
        <div class="animate__animated animate__backInRight animate__delay-0.7s">
        <input type="text" class="form-control w-50 w-md-50 mx-auto my-3 text-center location-input" placeholder="Enter your location">
        <a href="registration.php" class="btn btn-lg find-bike-btn" >Find a Bike Near You</a>
        </div>
        <div class="floating-icon" style="top: 200px; left: 10%;">
            <img src="images/floaticon.png" alt="Bike Icon">
        </div>
        <div class="floating-icon" style="top: 130px; right: 42%;">
            <img src="images/map .png" alt="map Icon">
        </div>
        <div class="floating-icon" style="top: 490px; left: 5%;">
            <img src="images/environmentalism.png" alt="environmentalism Icon">
        </div>
        <div class="floating-icon" style="top: 200px; right: 5%;">
            <img src="images/battery.png" alt="battery Icon">
        </div>
        <div class="floating-icon" style="top: 490px; right: 5%;">
            <img src="images/medal.png" alt="medal Icon">
        </div>
    </div>
</section>
  <!-- End of the hero section -->

   <!-- Begining of the big image section image  -->
<section class="familybicycle">
    <div>
        <img src="images/familybicycle.jpg" alt="Bike by the beach" class="sticky-top shadow img-fluid" >
    </div>
</section>
   <!-- End of the big image section image  -->

   <!-- Begining of Ride Smart section -->

   <div class="container ride_smart mb-5 pb-3">
    <div class="row mt-5 pt-5">
        <div class="col">
            <h2 class="mt-3 ">How it works</h3>
            <p class="mt-3">As easy as it gets</p>
        </div>
    </div>
    <div class="row mt-5 p-5">
        <div class="col-md-4 text-center">
            <img src="images/scanning.png" alt="scan bicycle" class="img-fluid mx-auto mb-5">
            <h3 class="text-center">1. Unlock it</h3>
            <p>Pick a bike, scan with the Peddle app, and ride!</p>
        </div>
        <div class="col-md-4 text-center">
            <img src="images/ride.png" alt="ride bicycle" class="img-fluid mx-auto mb-5">
            <h3 class="text-center">2. Ride it</h3>
            <p class="text-center">Hop on and start Peddling!</p>
        </div>
        <div class="col-md-4 text-center">
            <img src="images/park.png" alt="park bicycle" class="img-fluid mx-auto mb-5">
            <h3 class="text-center">3. Park it</h3>
            <p>Find a dock, lock it in, and you're good to go!</p>
        </div>
    </div>
</div>

   <!-- End of Ride Smart section -->

  <!-- Begining of the services section -->
  <section class="text-center py-5 section1" style="background-color: #F7F7F2;">
    <h1 class="fw-bold  mt-5 p-3 services_header" >Our Services</h1>
    <p class="lead text-secondary px-3 p-service" style="font-size: 1.2rem; max-width: 700px; margin: auto;">
        Why walk when you can ride? 
        <img src="images/bicycleicon.png" alt="bicycleicon">
        Unlock a bike and hit the road!
    </p>

    <div class="row justify-content-center mt-5 pt-5 ">
        <div class="col-md-4">
            <div class="card-container">
                <img src="images/rentbike.jpg" alt="Rent bike" class="card-image">
                <div class="floating-card ">
                    <h5 class="fw-bold">Bike Rental</h5>
                    <p class="text-muted">Find and rent a bike easily in your city.</p>
                    <a href="#" class="see-more">Rent a Bike</a>
                </div>
            </div>
        </div>
                  
        <div class="col-md-4 mt-5 pt-5">
            <div class="card-container">
                <img src="images/bikesharing.jpg" alt="Rent bike" class="card-image">
                <div class="floating-card">
                    <h5 class="fw-bold">Bike Sharing</h5>
                    <p class="text-muted">Bike with others and earn money.</p>
                    <a href="registration.php" class="see-more">Share Now</a>
                </div>
            </div>
        </div>
    </div>
                                                  
    <div class="row justify-content-center pt-5 mt-5">
        <div class="col-md-4 ">
            <div class="card-container">
                <img src="images/membership.jpg" alt="Rent bike" class="card-image">
                <div class="floating-card">
                    <h5 class="fw-bold">Membership</h5>
                    <p class="text-muted">Unlimited rides with our membership plan.</p>
                    <a href="registration.php" class="see-more">Join Now</a>
                </div>
            </div>
        </div>
        
        <div class="col-md-4 mt-5 pt-5 mt-5">
            <div class="card-container">
                <img src="images/smartdocking.jpg" alt="Rent bike" class="card-image">
                <div class="floating-card">
                    <h5 class="fw-bold">Smart Docking</h5>
                    <p class="text-muted">No docking station? No problem! Peddle lets you park in safe zones.</p>
                    <a href="registration.php" class="see-more">Find Parking</a>
                </div>
            </div>
        </div>
    </div>
    
    <div class="row justify-content-center pt-5 mt-5">
        <div class="col-md-4 ">
            <div class="card-container">
                <img src="images/achievement.jpg" alt="Rent bike" class="card-image img-fluid">
                <div class="floating-card">
                    <h5 class="fw-bold">Events & Challenges</h5>
                    <p class="text-muted">Join weekly cycling challenges & win exciting rewards!</p>
                    <a href="#" class="see-more">Sign Up</a>
                </div>
            </div>
        </div>
        
        <div class="col-md-4 pt-5 mt-5 mb-5 pb-5">
            <div class="card-container">
                <img src="images/advertisment.jpg" alt="Rent bike" class="card-image img-fluid">
                <div class="floating-card">
                    <h5 class="fw-bold">Advertise on Peddle</h5>
                    <p class="text-muted">Boost your brand! Advertise on our bikes & reach thousands of commuters.</p>
                    <a href="#" class="see-more">Partner with Us</a>
                </div>
            </div>
        </div>
    </div>
</section>
   <!-- End of the services section -->



   <!-- Begining of why choose us section -->
<section class="py-5 why-choose " style="background-color: #073B4C; color: #F7F7F2;">
<div class="container text-center mt-5 pt-5" >
            <h2 class="fw-bold mb-3">Why Choose Peddle?</h2>
            <p>Ride Smart, Ride Easy!</p>
    <div class="row align-items-center mb-5 mt-5 pt-5">
        <div class="col-md-6">
            <img src="images/convenience.jpg" alt="Convenience" class="img-fluid rounded">
        </div>
        <div class="col-md-6 text-center">
            <h4 class="fw-bold">Ride Anytime, Anywhere</h4>
            <p >With Peddle, bikes are always available when you need them—no hassle, no waiting.</p>
        </div>
    </div>

    <div class="row align-items-center mb-5 mt-5 pt-5">
        <div class="col-md-6 text-center">
            <h4 class="fw-bold">Affordable & Flexible</h4>
            <p>Enjoy budget-friendly rates with multiple rental options to fit your needs.</p>
        </div>
        <div class="col-md-6">
            <img src="images/affordable.jpg" alt="Affordable" class="img-fluid rounded">
        </div>
    </div>

    <div class="row align-items-center mb-5 mt-5 pt-5">
        <div class="col-md-6">
            <img src="images/sustainability.jpg" alt="Sustainability" class="img-fluid rounded">
        </div>
        <div class="col-md-6 text-center">
            <h4 class="fw-bold">Eco-Friendly Rides</h4>
            <p>Reduce your carbon footprint while commuting efficiently with our sustainable bikes.</p>
        </div>
    </div>
</div>
</section>
   <!-- End of why choose us section -->

   <!-- Begining of pricing section  -->
   <section class="py-5 pricing-section " style="background-color: #F7F7F2;" >
    <div class="container-fluid mt-5 pt-5 ">
        <div class="pb-5 ms-5">
        <h2 class="fw-bold bb-3"> Plans and Pricing</h2>
        <p>Flexible options that fit your ride style.</p>
        </div>

        <div class="row justify-content-center g-4 ">
            <div class="col-md-3 d-flex">
                <div class="card border-0 shadow-sm p-4 h-100 d-flex flex-column ">
                    <h4 class="fw-bold text-center mt-4">Single ride</h4>
                    <img src="images/bicycle (1).png" alt="bicycle" class="picture img-fluid mx-auto mt-4">
                    <h4 class="text-center mt-2 ">
                        <img src="images/naira.png" alt="naira symbol"> 5,000 per ride
                    </h4>
                    <p class="text-center">Perfect for occasional riders.</p>
                    <ul class="list-unstyled flex-grow-1">
                        <li><img src="images/bicycleicon.png" alt="bicycleicon"> Unlimited unlocks</li>
                        <li><img src="images/atm-card.png" alt="atm card"> No commitments</li>
                        <li><img src="images/location.png" alt="location symbol"> Ride anywhere</li>
                    </ul>
                    <a href="registration.php" class="btn custom-btn mt-auto mb-2">Get Started</a>
                </div>
            </div>

            <div class="col-md-3 d-flex">
                <div class="card border-0 shadow-sm p-4 h-100 d-flex flex-column">
                    <h4 class="fw-bold text-center">Monthly membership</h4>
                    <img src="images/single.png" alt="single ride" class="picture mx-auto">
                    <h4 class="text-center mt-3">
                        <img src="images/naira.png" alt="naira symbol"> 9,000/month
                    </h4>
                    <p class="text-center">Best for regular commuters.</p>
                    <ul class="list-unstyled flex-grow-1">
                        <li><img src="images/check-mark.png" alt="check mark"> Unlimited 30-min rides</li>
                        <li><img src="images/recycling-symbol.png" alt="recycling-symbol"> Free ride swaps</li>
                        <li><img src="images/money.png" alt="money"> Save more on each ride</li>
                    </ul>
                    <a href="registration.php" class="btn custom-btn mt-auto mb-2">Join Now</a>
                </div>
            </div>

            <div class="col-md-3 d-flex ">
                <div class="card border-0 shadow-sm p-4 h-100 d-flex flex-column">
                    <h4 class="fw-bold text-center">Annual membership</h4>
                    <img src="images/cycling.png" alt="cycling" class="picture mx-auto">
                    <h4 class="text-center mt-3">
                        <img src="images/naira.png" alt="naira symbol"> 30,000/year
                    </h4>
                    <p class="text-center">Ride worry-free all year.</p>
                    <ul class="list-unstyled flex-grow-1">
                        <li><img src="images/fire.png" alt="fire"> Best value for top riders</li>
                        <li><img src="images/rocket.png" alt="rocket"> Unlimited rides</li>
                        <li><img src="images/gift.png" alt="gift"> Exclusive perks</li>
                    </ul>
                    <a href="registration.php" class="btn custom-btn mt-auto mb-2">Subscribe</a>
                </div>
            </div>
        </div>
    </div>

    <div class="text-center mt-5">
        <h4 class="fw-bold text-dark">One membership. A bunch of perks.</h4>
        <p class="lead text-secondary">Enjoy discounted e-bike rates, zero unlock fees, and exclusive perks with a Peddle membership</p>
    </div>
</section>
   <!-- End of pricing section  -->

   <!-- Begining of pictures grid -->
   <section class="about-us ">
  <div class="container mt-5 pt-5">
    <div class="swiper mySwiper">
      <div class="swiper-wrapper">
        <div class="swiper-slide">
          <img src="images/grid1.jpg" class="img-fluid rounded">
        </div>
        <div class="swiper-slide">
          <img src="images/grid2.jpg" class="img-fluid rounded">
        </div>
        <div class="swiper-slide">
          <img src="images/grid3.jpg" class="img-fluid rounded">
        </div>
        <div class="swiper-slide">
          <img src="images/grid4.jpg" class="img-fluid rounded">
        </div>
        <div class="swiper-slide">
          <img src="images/grid5.jpg" class="img-fluid rounded">
        </div>
        <div class="swiper-slide">
          <img src="images/grid6.jpg" class="img-fluid rounded">
        </div>
      </div>
    </div>
  </div>

  <div class="text-center py-5 mt-3" style="background-color: #073B4C; color: #F7F7F2; font-family: 'Poppins', sans-serif;">
    <h2 class="fw-bold" style="font-family: 'Pacifico', cursive; font-size: 2.5rem;">Peddle: Your Ride, Your Way</h2>
    <p class="lead" style="font-size: 1.2rem; font-weight: 400;">We make urban commuting easier, greener, and more fun. Join the ride today.</p>
    <a href="#" class="btn white-btn">Find Parking</a>
  </div>
</section>

  
   <!-- End of pictures grid -->

   <!-- FAQS -->
<!-- FAQS -->
<div class="container-fluid py-5" style="background-color: white; color: black; font-family: 'Inter', sans-serif;">
    <div class="row">
        <div class="col-md-12 text-center">
            <h3 class="mt-4" style="font-weight: 700; letter-spacing: 1px; text-transform: uppercase; color:#454445;">FAQ</h3>
            <h1 class="display-5" style="font-family: 'Pacifico', cursive;color:#073B4C;">Got Questions? We've Got Answers!</h1>
        </div>
    </div>

    <div class="row mt-5">
        <div class="col-md-6 px-4">
            <div class="accordion accordion-flush" id="faqAccordion1">
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#q1" style="font-weight: 600;">
                            How do I rent a bike?
                        </button>
                    </h2>
                    <div id="q1" class="accordion-collapse collapse" data-bs-parent="#faqAccordion1">
                        <div class="accordion-body" style="font-size: 1rem;">Open the Peddle app, find a nearby bike, scan the QR code, and unlock it. You're ready to ride!</div>
                    </div>
                </div>

                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#q2" style="font-weight: 600;">
                            How much does it cost to use Peddle?
                        </button>
                    </h2>
                    <div id="q2" class="accordion-collapse collapse" data-bs-parent="#faqAccordion1">
                        <div class="accordion-body" style="font-size: 1rem;">Peddle offers flexible pricing plans, including pay-per-ride and monthly memberships. Check the pricing section in the app for details.</div>
                    </div>
                </div>

                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#q3" style="font-weight: 600;">
                            Where can I park the bike?
                        </button>
                    </h2>
                    <div id="q3" class="accordion-collapse collapse" data-bs-parent="#faqAccordion1">
                        <div class="accordion-body" style="font-size: 1rem;">You can park at any designated Peddle docking station. Make sure to lock the bike properly to end your trip.</div>
                    </div>
                </div>

                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#q4" style="font-weight: 600;">
                            Do I need a deposit to rent a bike?
                        </button>
                    </h2>
                    <div id="q4" class="accordion-collapse collapse" data-bs-parent="#faqAccordion1">
                        <div class="accordion-body" style="font-size: 1rem;">No deposit is required. You only pay for the ride based on your selected plan.</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 px-4">
            <div class="accordion accordion-flush" id="faqAccordion2">
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#q5" style="font-weight: 600;">
                            What if my bike has a problem during my ride?
                        </button>
                    </h2>
                    <div id="q5" class="accordion-collapse collapse" data-bs-parent="#faqAccordion2">
                        <div class="accordion-body" style="font-size: 1rem;">If you experience an issue, stop riding and report it through the Peddle app. You can also switch to another available bike nearby.</div>
                    </div>
                </div>

                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#q6" style="font-weight: 600;">
                            Is there a time limit for using the bike?
                        </button>
                    </h2>
                    <div id="q6" class="accordion-collapse collapse" data-bs-parent="#faqAccordion2">
                        <div class="accordion-body" style="font-size: 1rem;">Yes, each ride has a maximum duration based on your plan. Extra time may result in additional charges.</div>
                    </div>
                </div>

                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#q7" style="font-weight: 600;">
                            Can I reserve a bike in advance?
                        </button>
                    </h2>
                    <div id="q7" class="accordion-collapse collapse" data-bs-parent="#faqAccordion2">
                        <div class="accordion-body" style="font-size: 1rem;">Currently, bikes are available on a first-come, first-served basis. Stay tuned for future updates on reservations.</div>
                    </div>
                </div>

                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#q8" style="font-weight: 600;">
                            What happens if I forget to lock the bike?
                        </button>
                    </h2>
                    <div id="q8" class="accordion-collapse collapse" data-bs-parent="#faqAccordion2">
                        <div class="accordion-body" style="font-size: 1rem;">If the bike is not properly locked, the trip remains active, and you may continue to be charged. Always double-check before leaving.</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
   <!-- End of FAQS -->

   <!-- Begining of call to action section  -->
<section class="py-5 text-center" style="background-color: #073B4C; color: #F7F7F2; font-family: 'Inter', sans-serif;">
    <div class="container">
        <h2 class="fw-bold" style="font-size: 2.5rem;">Ready to Ride?</h2>
        <p class="lead" style="font-size: 1.2rem;">Join Peddle today and experience hassle-free bike rentals at your fingertips.</p>

        <div class="my-4">
            <img src="images/get-started.jpg" alt="Cyclist on a Peddle bike" 
                 class="img-fluid rounded shadow-lg" 
                 style="max-width: 100%; height: auto;">
        </div>  

        <a href="#" class="btn btn-lg" 
           style="background-color: white; color: black; font-weight: bold; padding: 12px 24px; border-radius: 30px; transition: 0.3s;">
            Get Started
        </a>
    </div>
</section>
   <!-- End of call to action section  -->

   <!-- Begining of footer -->
   <footer class="py-5" style="background-color: #032B43; color: #F7F7F2;">
    <div class="container">
      <div class="row">
 
        <div class="col-md-3 mb-4">
          <h4 class="fw-bold">Peddle</h4>
          <p>Ride Smart, Ride Easy.</p>
        </div>
        

        <div class="col-md-3 mb-4">
          <h5 class="fw-bold">Quick Links</h5>
          <ul class="list-unstyled">
            <li><a href="#" class="text-decoration-none text-light">Home</a></li>
            <li><a href="#" class="text-decoration-none text-light">How It Works</a></li>
            <li><a href="#" class="text-decoration-none text-light">Pricing</a></li>
            <li><a href="#" class="text-decoration-none text-light">About Us</a></li>
          </ul>
        </div>
        

        <div class="col-md-3 mb-4">
          <h5 class="fw-bold">Support</h5>
          <p>Email: <a href="mailto:support@peddle.com" class="text-light">support@peddle.com</a></p>
          <p>Phone: +234 805 050 0170</p>
        </div>
        

        <div class="col-md-3 mb-4">
          <h5 class="fw-bold">Stay Updated</h5>
          <form>
            <input type="email" class="form-control mb-2" placeholder="Enter your email">
            <button class="btn" style="background-color: #9D5C63; color: #F7F7F2;">Subscribe</button>
          </form>
        </div>
      </div>
      

      <div class="text-center mt-4">
        <p class="mb-0">&copy; 2025 Peddle. All Rights Reserved.</p>
      </div>
    </div>
  </footer>
   <!-- End of footer -->

<script src="jquerymin.js"></script>
<script src="bootstrap/js/bootstrap.bundle.js" type="text/javascript"></script>
<script src="swiper/js/swiper-bundle.min.js"></script>
<script src="swiper/js/swiper-init.js"></script>
<script src="js/peddle.js"></script>
</body>
</html>
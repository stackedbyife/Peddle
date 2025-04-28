<?php
require_once '../../classes/Rental.php';

if (isset($_POST['lga_id'])) {
    $rental = new Rental();
    $stations = $rental->getStationsByLga($_POST['lga_id']);
    
    if(empty($stations)){
        echo '
        <div class="alert alert-warning d-flex align-items-center mt-3 shadow-sm rounded-3" role="alert" style="background-color: #fff9e6; border-left: 6px solid #ffc107;">
            <i class="fas fa-exclamation-triangle me-2 text-warning" style="font-size: 1.3rem;"></i>
            <div>
                <strong>Oops!</strong> No stations here yet — the &nbsp&nbsp&nbsp&nbspbikes must be on vacation 🏖️
            </div>
        </div>
        ';

        echo '<script>
                $("#bicycleField").hide();
            </script>';
    }else{
    ?>


    <div class="form-group mt-4" >
        <label for="start_station_id" class="form-label"><i class="fas fa-map-marker-alt me-2"></i> Select Start Station:</label>
            <select name="start_station_id" id="start_station_id" class="form-control" required>
              <option value="">Select Station</option>
              <?php foreach ($stations as $station): ?>
                <option value="<?= $station['station_id']; ?>"><?= $station['station_name']; ?></option>
              <?php endforeach; ?>
            </select>
    </div>
    
    <div id="bicycleField" class="mt-3">
  
        </div>

        <script>
          
            $("#bicycleField").show();
        </script>


<?php
}}
?>
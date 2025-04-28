<?php
require_once '../../classes/Rental.php';

if (isset($_POST['station_id'])) {
    $rental = new Rental();
    $bicycles = $rental->getAvailableBicyclesByStation($_POST['station_id']);
    ?>

        <div class="form-group" >
            <label for="bicycle_id" class="form-label"><i class="fas fa-bicycle me-2"></i> Select Bicycle:</label>
            <select name="bicycle_id" id="bicycle_id" class="form-control" required>
              <option value="">Select Bicycle</option>
              <?php foreach ($bicycles as $bicycle): ?>
                <option value="<?= $bicycle['bicycle_id'] ?>"><?= $bicycle['bicycle_number'] ?></option>
              <?php endforeach; ?>
            </select>
        </div>

    <div class="mt-3">
      <button type="submit" class="btn btn-gradient btn-lg fw-semibold px-4 py-3">
        <i class="fas fa-bicycle me-2"></i> Rent Now
      </button>
    </div>

<?php
}
?>
<?php include "./../../view/header.php" ?>
<?php 
require("./../../model/database.php");
require("./../../model/users.php");
require("./../../model/rentals.php");
require("./../../model/vehicles.php");

$error_message = "";
$success_message = "";

$vehicle_id = filter_input(INPUT_GET, 'vehicle_id', FILTER_VALIDATE_INT);
$vehicle = get_vehicle_by_id($vehicle_id);

$action = filter_input(INPUT_POST, 'action');

if ($action == "rent_vehicle") {
  $un = filter_input(INPUT_POST, 'username');
  $user = get_user_by_username($un);

  if ($user == NULL || $user == FALSE) {
    $error_message = "Username does not exist.";
    $success_message = "";
  } else if ($vehicle = NULL || $vehicle == FALSE) {
    $error_message = "Vehicle does not exist.";
    $success_message = "";
  } else {
    $pickup_address = filter_input(INPUT_POST, 'pickup_address');
    $pickup_city = filter_input(INPUT_POST, 'pickup_city');
    $pickup_state = filter_input(INPUT_POST, 'pickup_state');
    $pickup_country = filter_input(INPUT_POST, 'pickup_country');
    $pickup_zip = filter_input(INPUT_POST, 'pickup_zip');
  
    $pickup_time = filter_input(INPUT_POST, 'pickup_time');
  
    $dropoff_address = filter_input(INPUT_POST, 'dropoff_address');
    $dropoff_city = filter_input(INPUT_POST, 'dropoff_city');
    $dropoff_state = filter_input(INPUT_POST, 'dropoff_state');
    $dropoff_country = filter_input(INPUT_POST, 'dropoff_country');
    $dropoff_zip = filter_input(INPUT_POST, 'dropoff_zip');
  
    $dropoff_time = filter_input(INPUT_POST, 'dropoff_time');
    
    $pickup_address_str = "$pickup_address, $pickup_city";
    $pickup_address_str .= $pickup_state ? ", $pickup_state" : "";
    $pickup_address_str .= ", $pickup_country $pickup_zip";
  
    $dropoff_address_str = "$dropoff_address, $dropoff_city";
    $dropoff_address_str .= $dropoff_state ? ", $dropoff_state" : "";
    $dropoff_address_str .= ", $dropoff_country $dropoff_zip";

    if (is_rental_available($vehicle_id, $pickup_time, $dropoff_time)) {
      add_rental($user['id'], $vehicle_id, $pickup_address_str, $pickup_time, $dropoff_address_str, $dropoff_time);
      $success_message = "Rental added.";
      $error_message = "";
      $vehicle = get_vehicle_by_id($vehicle_id);
    } else {
      $error_message = "Rental not available.";
      $success_message = "";
      $vehicle = get_vehicle_by_id($vehicle_id);
    }
  } 
}
?>
<main>
  <div class="vehicle-detail">
    <div class="cont">
      <div class="name-cont">
        <h1 class="name"><?php echo($vehicle["name"]) ?></h1>
        <h2 class="type"><?php echo($vehicle["vehicle_type"] == "suv" ? "SUV" : ucwords($vehicle["vehicle_type"])); ?></h2>
        <div>
          <p class="vin"><?php echo("VIN: " . $vehicle['vin']) ?></p>
          <p class="brand"><?php echo("Brand: " . $vehicle['brand']) ?></p>
          <p class="model"><?php echo("Model: " . $vehicle['model']) ?></p>
          <p class="year"><?php echo("Year: " . $vehicle['year']) ?></p>
        </div>
      </div>
      <div class="price-cont">
        <p class="ppd"><span><?php echo("$" . strval($vehicle["price_per_day"])) ?></span> / day</p>
        <p class="mileage">Mileage (mi / day): <span><?php echo($vehicle["unlimited_mileage"] ? "Unlimited" : $vehicle["mileage_limit"]) ?><span></p>
        <p class="ppg">Prepaid Gas: <span><?php echo($vehicle["prepaid_gas"] ? "Yes" : "No") ?></span></p>
      </div>
    </div>
    <form id="rent-form" method="POST">
      <?php if ($error_message) : ?>
        <div class="error-msg"><?php echo $error_message; ?></div>
      <?php endif ?>
      <?php if ($success_message) : ?>
        <div class="success-msg"><?php echo $success_message; ?></div>
      <?php endif ?>
      <input type="hidden" name="action" value="rent_vehicle">
      <div class="username-cont">
        <label>Enter your username (First Middle Last)</label>
        <div>
          <input type="text" name="username" placeholder="Username">
        </div>
      </div>
      <fieldset>
        <legend>Pickup</legend>
        <div class="address-cont">
          <input class="address" type="text" name="pickup_address" placeholder="Address" required>
          <input class="city" type="text" name="pickup_city" placeholder="City" required>
          <input class="state" type="text" name="pickup_state" placeholder="State/Province">
          <input class="country" type="text" name="pickup_country" placeholder="Country" required>
          <input class="zip" type="text" name="pickup_zip" placeholder="Zip Code" required>
        </div>
        <div>
          <input type="datetime-local" name="pickup_time" required>
        </div>
      </fieldset>
      <fieldset>
        <legend>Dropoff</legend>
        <div class="address-cont">
          <input class="address" type="text" name="dropoff_address" placeholder="Address" required>
          <input class="city" type="text" name="dropoff_city" placeholder="City" required>
          <input class="state" type="text" name="dropoff_state" placeholder="State/Province">
          <input class="country" type="text" name="dropoff_country" placeholder="Country" required>
          <input class="zip" type="text" name="dropoff_zip" placeholder="Zip Code" required>
        </div>
        <div>
          <input type="datetime-local" name="dropoff_time" required>
        </div>
      </fieldset>
      <div style="text-align: right;">
        <input class="btn" type="submit" value="Rent">
      </div>
    </form>
  </div>
</main>
<?php include "./../../view/footer.php" ?>

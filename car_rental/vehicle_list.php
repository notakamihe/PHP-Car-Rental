<ul id="vehicles-list">
  <?php foreach ($vehicles as $vehicle) : ?>
    <li class="vehicles-li">
      <div>
        <p class="vin">VIN: <?php echo($vehicle['vin']) ?></p>
        <h2 class="name-and-year"><?php echo("{$vehicle['name']} ({$vehicle['year']})") ?></h2>
      </div>
      <div>
        <a class="btn" href="<?php echo("vehicle?vehicle_id={$vehicle["id"]}") ?>">Rent</a>
      </div>
    </li>
  <?php endforeach; ?>
</ul>
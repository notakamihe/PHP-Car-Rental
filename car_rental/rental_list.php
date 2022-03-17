<div id="rentals-list">
  <form class="username-cont" action="index.php" method="POST" style="margin: 0 0 32px 32px;">
    <input type="hidden" name="action" value="find_rentals">
    <label>Enter your username (First Middle Last)</label>
    <div>
      <input type="text" name="username" placeholder="Enter username" />
      <input type="submit" name="submit" value="View your Rentals" />
    </div>
  </form>
  <ul>
    <?php foreach($joined_rentals as $rental) : ?>
      <li>
        <p class="vin">VIN: <?php echo($rental['vin']); ?></p>
        <h2 class="name-and-year"><?php echo($rental['name'] . " ({$rental['year']})"); ?></h2>
        <p class="pickup">Pickup: <?php echo("{$rental['pickup_location']} on " . date("D, M d, Y g:i a", strtotime($rental['pickup_time']))); ?></p>
        <p class="dropoff">Dropoff: <?php echo("{$rental['dropoff_location']} on " . date("D, M d, Y g:i a", strtotime($rental['dropoff_time']))); ?></p>
      </li>
    <?php endforeach; ?>
  </ul>
</div>
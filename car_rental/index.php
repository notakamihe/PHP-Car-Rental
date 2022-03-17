<?php include "./../view/header.php" ?>
<?php
require("./../model/database.php");
require("./../model/rentals.php");
require("./../model/users.php");
require("./../model/vehicles.php");

$action = filter_input(INPUT_POST, 'action');

if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action');
    if ($action == NULL) {
        $action = 'list_vehicles';
    }
}

$vehicles = get_vehicles();
$joined_rentals = [];

if ($action == "find_rentals") {
  $un = filter_input(INPUT_POST, 'username');
  $user = get_user_by_username($un);
  $joined_rentals = get_joined_rentals($user['id']);
}
?>
<main>
  <div id="car-rental">
    <aside>
      <a href="?action=list_vehicles">Vehicles</a>
      <a href="?action=list_rentals">Rentals</a>
    </aside>
    <?php 
      if ($action == "list_rentals" || $action == "find_rentals") {
        include("./rental_list.php");
      } elseif ($action == "list_vehicles") {
        include("./vehicle_list.php");
      }
    ?>
  </div>
</main>
<?php include "./../view/footer.php" ?>

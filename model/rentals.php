<?php 
function add_rental($user_id, $vehicle_id, $pickup_location, $pickup_time, $dropoff_location, $dropoff_time) {
  global $db;

  $query = 'INSERT INTO rentals (user_id, vehicle_id, pickup_location, pickup_time, dropoff_location, dropoff_time) 
              VALUES (:user_id, :vehicle_id, :pickup_location, :pickup_time, :dropoff_location, :dropoff_time)';  
  $statement = $db->prepare($query);

  $statement->bindValue(':user_id', $user_id);
  $statement->bindValue(':vehicle_id', $vehicle_id);
  $statement->bindValue(':pickup_location', $pickup_location);
  $statement->bindValue(':pickup_time', $pickup_time);
  $statement->bindValue(':dropoff_location', $dropoff_location);
  $statement->bindValue(':dropoff_time', $dropoff_time);

  $statement->execute();
  $statement->closeCursor();
}

function get_joined_rentals($user_id) {
  global $db;

  $query = 'SELECT * FROM rentals 
	            INNER JOIN users ON users.id = rentals.user_id
              INNER JOIN vehicles ON vehicles.id = rentals.vehicle_id
              WHERE rentals.user_id = :user_id';
  $statement = $db->prepare($query);
  $statement->bindValue(':user_id', $user_id);
  $statement->execute();
  $joined_rentals = $statement->fetchAll();
  $statement->closeCursor();
  return $joined_rentals;
}

function is_rental_available($vehicle_id, $pickup_time, $dropoff_time) {
  global $db;

  $query = 'SELECT * FROM rentals WHERE 
	            vehicle_id = :vehicle_id AND
	            (:pickup_time BETWEEN pickup_time AND dropoff_time OR :dropoff_time BETWEEN pickup_time AND dropoff_time);';
  $statement = $db->prepare($query);
  $statement->bindValue(':vehicle_id', $vehicle_id);
  $statement->bindValue(':pickup_time', $pickup_time);
  $statement->bindValue(':dropoff_time', $dropoff_time);
  $statement->execute();
  $rentals = $statement->fetchAll();
  $statement->closeCursor();

  return count($rentals) == 0;
}
?>
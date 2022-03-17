<?php
function get_vehicle_by_id($id) {
  global $db;

  $query = "SELECT * FROM vehicles WHERE id = :id";
  $statement = $db->prepare($query);
  $statement->bindValue(":id", $id);
  $statement->execute();
  $vehicle = $statement->fetch();
  $statement->closeCursor();
  
  return $vehicle;
}

function get_vehicles() {
  global $db;

  $query = 'SELECT * FROM vehicles ORDER BY id';
  $statement = $db->prepare($query);
  $statement->execute();
  $vehicles = $statement->fetchAll();
  $statement->closeCursor();

  return $vehicles;
}
?>
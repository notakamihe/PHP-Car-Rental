<?php
function add_user($username) {
  global $db;

  $query = 'INSERT INTO users (username) VALUES (:username)';
  $statement = $db->prepare($query);
  $statement->bindValue(':username', $username);
  $statement->execute();
  $statement->closeCursor();
}

function get_user_by_username($username) {
  global $db;

  $query = 'SELECT * FROM users WHERE username = :username';
  $statement = $db->prepare($query);
  $statement->bindValue(':username', $username);
  $statement->execute();
  $user = $statement->fetch();
  $statement->closeCursor();

  return $user;
}

function get_users_by_username($username) {
  global $db;

  $query = 'SELECT * FROM users WHERE username = :username';
  $statement = $db->prepare($query);
  $statement->bindValue(':username', $username);
  $statement->execute();
  $users = $statement->fetchAll();
  $statement->closeCursor();

  return $users;
}
?>
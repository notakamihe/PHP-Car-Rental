<?php 
require('model/database.php');
require('model/users.php');
 
$error_message = "";
$success_message = "";
$action = filter_input(INPUT_POST, 'action');

if ($action == "register_user") {
  $un = filter_input(INPUT_POST, 'username');

  if ($un == NULL || $un == FALSE || $un == "") {
    $error_message = "Please enter a username.";
    $success_message = "";
  }

  $users = get_users_by_username($un);

  if (count($users) > 0) {
    $error_message = "Username not available.";
    $success_message = "";
  } else {
    add_user($un);
    $success_message = "User added.";
    $error_message = "";
  }
}
?>

<h3>Create a user</h3>
<form id="register-form" action="?" method="post">
  <input type="hidden" name="action" value="register_user">
  <div>
    <label>Username (First Middle Last)</label>
    <div>
      <input type="text" name="username" placeholder="Enter username">
    </div>
  </div>
  <div>
    <input class="btn" type="submit" name="register" value="Register">
  </div>
  <?php if ($error_message) : ?>
    <div class="error-msg2"><?php echo $error_message; ?></div>
  <?php endif ?>
  <?php if ($success_message) : ?>
    <div class="success-msg2"><?php echo $success_message; ?></div>
  <?php endif ?>
</form>
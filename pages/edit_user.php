<?php 

require_once('../templates/common_tpl.php');
require_once('../templates/ticket_tpl.php');
require_once('../database/connection.php');
require_once('../database/ticket.php');
require_once('../database/user.php');
require_once('../types/user.php');

session_start();

$db = getDatabaseConnection();
$user = getUser($db, $_SESSION['username']);

common_header(); ?>

<h1>Edit User Information</h1>
    <form method="POST" action="../actions/action_edit_user.php">
        <input type="hidden" name="userId" value="<?php echo $user->id; ?>">
        <input type="hidden" name="userType" value="<?php echo $user->type->toString(); ?>">
        <label for="username">Username:</label>
        <input type="text" name="username" placeholder="<?php echo $user->username; ?>" required><br><br>

        <label for="email">Email:</label>
        <input type="email" name="email" placeholder="<?php echo $user->email; ?>" required><br><br>

        <label for="first_name">First Name:</label>
        <input type="text" name="first_name" placeholder="<?php echo $user->firstName; ?>" required><br><br>

        <label for="first_name">Last Name:</label>
        <input type="text" name="last_name" placeholder="<?php echo $user->lastName; ?>" required><br><br>

        <input type="submit" value="Save">
    </form>


<?php common_footer(); ?> 
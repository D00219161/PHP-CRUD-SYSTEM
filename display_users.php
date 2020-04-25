<?php

/**
 * Start the session.
 */
session_start();

/**
 * Check if the user is logged in.
 */
if(!isset($_SESSION['user_id']) || !isset($_SESSION['logged_in'])){
    //User not logged in. Redirect them back to the login.php page.
    header('Location: login.php');
    exit;
}

// Connect to the database
require_once('database.php');
// Set the default user to the ID of 1
if (!isset($user_id)) {
$user_id = filter_input(INPUT_GET, 'user_id', 
FILTER_VALIDATE_INT);
if ($user_id == NULL || $user_id == FALSE) {
$user_id = 1;
}
}
// Get name for current user
$queryUser = "SELECT * FROM users
WHERE id = :user_id";
$statement1 = $db->prepare($queryUser);
$statement1->bindValue(':user_id', $user_id);
$statement1->execute();
$user = $statement1->fetch();
$statement1->closeCursor();
$user_name = $user['username'];
// Get all users
$queryAllUsers = 'SELECT * FROM users
ORDER BY id';
$statement2 = $db->prepare($queryAllUsers);
$statement2->execute();
$users = $statement2->fetchAll();
$statement2->closeCursor();
?>
<!DOCTYPE html>
<html>
<!-- the head section -->
<link href="https://fonts.googleapis.com/css?family=Lato&display=swap" rel="stylesheet">
<head>
<title>NETFLIX</title>
<link rel="stylesheet" type="text/css" href="./SASS/main.css">
</head>
<!-- the body section -->
<body>
<header>
<h1>NETFLIX</h1>
<nav>
<a href="manage_films.php">Films</a>
<a href="manage_shows.php">Shows</a>
<a href="logout.php">Logout</a>
<nav></header>
<main>
<h1>Users Displayed</h1>
<section class="users" users>
<!-- display a table of users from the database -->
<h2>Users</h2>
<table>
<tr>
<th>Name</th>
<th>Password</th>
<th>Email</th>
</tr>
<?php foreach ($users as $user) : ?>
<tr>
<td><?php echo $user['username']; ?></td>
<td><?php echo $user['password']; ?></td>
<td><?php echo $user['email']; ?></td>
</tr>
<?php endforeach; ?>
</table>
</section>
</main>
<footer>
<p>&copy; <?php echo date("Y"); ?> NETFLIX, Roisin McPhillips.</p>
</footer>
</body>
</html>
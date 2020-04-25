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

/**
 * Print out something that only logged in users can see.
 */
echo '<script type="text/javascript">alert("Congratulations! You are logged in!");</script>';

// Connect to the database
require_once('database.php');
// Set the default actor to the ID of 1
if (!isset($actor_id)) {
$actor_id = filter_input(INPUT_GET, 'actor_id', 
FILTER_VALIDATE_INT);
if ($actor_id == NULL || $actor_id == FALSE) {
$actor_id = 1;
}
}
// Get name for current actor
$queryActor = "SELECT * FROM actors
WHERE actorID = :actor_id";
$statement1 = $db->prepare($queryActor);
$statement1->bindValue(':actor_id', $actor_id);
$statement1->execute();
$actor = $statement1->fetch();
$statement1->closeCursor();
$actor_name = $actor['actorName'];
// Get all actors
$queryAllActors = 'SELECT * FROM actors
ORDER BY actorID';
$statement2 = $db->prepare($queryAllActors);
$statement2->execute();
$actors = $statement2->fetchAll();
$statement2->closeCursor();
// Get shows for selected actor
$queryShows = "SELECT * FROM shows
WHERE actorID = :actor_id
ORDER BY showID";
$statement3 = $db->prepare($queryShows);
$statement3->bindValue(':actor_id', $actor_id);
$statement3->execute();
$shows = $statement3->fetchAll();
$statement3->closeCursor();
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
<a href="display_users.php">Users</a>
<a href="logout.php">Logout</a>
<nav></header>
<main>
<h1>Shows</h1>
<aside>
<!-- display a list of actors in the sidebar-->
<h2>Actors</h2>
<nav>
<ul>
<?php foreach ($actors as $actor) : ?>
<li><a href="?actor_id=<?php echo $actor['actorID']; ?>">
<?php echo $actor['actorName']; ?>
</a>
</li>
<?php endforeach; ?>
</ul>
</nav>
</aside>
<section>
<!-- display a table of shows from the database -->
<h2><?php echo $actor_name; ?></h2>
<table>
<tr>
<th>Image</th>
<th>Name</th>
<th>Description</th>
<th>Release Date</th>
<th>Delete</th>
<th>Edit</th>
</tr>
<?php foreach ($shows as $show) : ?>
<tr>
<td><img src="image_uploads/<?php echo $show['image']; ?>" width="130px" height="150px" /></td>
<td><?php echo $show['name']; ?></td>
<td><?php echo $show['description']; ?></td>
<td><?php echo $show['releaseDate']; ?></td>
<td><form action="delete_show.php" method="post"
id="delete_show_form">
<input type="hidden" name="show_id"
value="<?php echo $show['showID']; ?>">
<input type="hidden" name="actor_id"
value="<?php echo $show['actorID']; ?>">
<input type="submit" value="Delete">
</form></td>
<td><form action="edit_show_form.php" method="post"
id="delete_show_form">
<input type="hidden" name="show_id"
value="<?php echo $show['showID']; ?>">
<input type="hidden" name="actor_id"
value="<?php echo $show['actorID']; ?>">
<input type="submit" value="Edit">
</form></td>
</tr>
<?php endforeach; ?>
</table>
<p><button><a href="add_show_form.php">Add a Show</a></button>
<button><a href="actor_list.php">Edit Actors</a></button></p>
</section>
</main>
<footer>
<p>&copy; <?php echo date("Y"); ?> NETFLIX, Roisin McPhillips.</p>
</footer>
</body>
</html>
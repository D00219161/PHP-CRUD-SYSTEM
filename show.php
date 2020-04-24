<?php
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
<a href="index.php">Films</a>
<a href="login.php">Login</a>
<a href="register.php">Register</a>
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
</tr>
<?php foreach ($shows as $show) : ?>
<tr>
<td><img src="image_uploads/<?php echo $show['image']; ?>" width="130px" height="150px" /></td>
<td><?php echo $show['name']; ?></td>
<td><?php echo $show['description']; ?></td>
<td><?php echo $show['releaseDate']; ?></td>
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
<?php
// Get the actor data
$name = $name = filter_input(INPUT_POST, 'name');
// Validate inputs
if ($name == null) {
    $error = "Invalid actor data. Check all fields and try again.";
    include('error.php');
} else {
    require_once('database.php');
    // Add the actor to the database
    $query = "INSERT INTO actors (actorName)
              VALUES (:name)";
    $statement = $db->prepare($query);
    $statement->bindValue(':name', $name);
    $statement->execute();
    $statement->closeCursor();
    // Display the actor List page
    include('actor_list.php');
}
?>
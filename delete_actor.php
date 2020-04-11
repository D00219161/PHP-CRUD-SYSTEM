<?php
// Get ID
$actor_id = filter_input(INPUT_POST, 'actor_id', FILTER_VALIDATE_INT);
// Validate inputs
if ($actor_id == null || $actor_id == false) {
    $error = "Invalid actor ID.";
    include('error.php');
} else {
    require_once('database.php');
    // Delete the actor from the database  
    $query = 'DELETE FROM actors 
              WHERE actorID = :actor_id';
    $statement = $db->prepare($query);
    $statement->bindValue(':actor_id', $actor_id);
    $statement->execute();
    $statement->closeCursor();
    // Display the Actor List page
    include('actor_list.php');
}
?>

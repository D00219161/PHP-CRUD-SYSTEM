<?php
require_once('database.php');
// Get IDs
$show_id = filter_input(INPUT_POST, 'show_id', FILTER_VALIDATE_INT);
$actor_id = filter_input(INPUT_POST, 'actor_id', FILTER_VALIDATE_INT);
// Delete the show from the database
if ($show_id != false && $actor_id != false) {
    $query = "DELETE FROM shows
              WHERE showID = :show_id";
    $statement = $db->prepare($query);
    $statement->bindValue(':show_id', $show_id);
    $statement->execute();
    $statement->closeCursor();
}
// display show's page
include('show.php');
?>
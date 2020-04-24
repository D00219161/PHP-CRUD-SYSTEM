<?php
// Get the data
$show_id = filter_input(INPUT_POST, 'show_id', FILTER_VALIDATE_INT);
$actor_id = filter_input(INPUT_POST, 'actor_id', FILTER_VALIDATE_INT);
$name = filter_input(INPUT_POST, 'name');
$description = filter_input(INPUT_POST, 'description');
$releaseDate = filter_input(INPUT_POST, 'releaseDate');
// Validate inputs
if ($show_id == NULL || $show_id == FALSE || $actor_id == NULL ||
$actor_id == FALSE || empty($name) || $description == NULL || $releaseDate == NULL) {
$error = "Invalid data. Check all fields and try again.";
include('error.php');
} else {
// Image upload
$imgFile = $_FILES['image']['name'];
$tmp_dir = $_FILES['image']['tmp_name'];
$imgSize = $_FILES['image']['size'];
$original_image = filter_input(INPUT_POST, 'original_image');
if ($imgFile) {
$upload_dir = 'image_uploads/'; // upload directory	
$imgExt = strtolower(pathinfo($imgFile, PATHINFO_EXTENSION)); // get image extension
$valid_extensions = array('jpeg', 'jpg', 'png', 'gif'); // valid extensions
$image = rand(1000, 1000000) . "." . $imgExt;
if (in_array($imgExt, $valid_extensions)) {
if ($imgSize < 5000000) {
if (filter_input(INPUT_POST, 'original_image') !== "") {
unlink($upload_dir . $original_image);                    
}
move_uploaded_file($tmp_dir, $upload_dir . $image);
} else {
$errMSG = "Sorry, your file is too large it should be less then 5MB";
}
} else {
$errMSG = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
}
} else {
// If no image selected the old image remain as it is.
$image = $original_image; // old image from database
}
// End Image upload

// If valid, update the shows in the database
require_once('database.php');
$query = 'UPDATE shows
SET actorID = :actor_id,
name = :name,
description = :description,
releaseDate = :releaseDate,
image = :image
WHERE showID = :show_id';
$statement = $db->prepare($query);
$statement->bindValue(':actor_id', $actor_id);
$statement->bindValue(':name', $name);
$statement->bindValue(':description', $description);
$statement->bindValue(':releaseDate', $releaseDate);
$statement->bindValue(':image', $image);
$statement->bindValue(':show_id', $show_id);
$statement->execute();
$statement->closeCursor();
// Display the show page
include('manage_shows.php');
}
?>
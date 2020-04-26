<?php
require('database.php');
$show_id = filter_input(INPUT_POST, 'show_id', FILTER_VALIDATE_INT);
$query = 'SELECT *
          FROM shows
          WHERE showID = :show_id';
$statement = $db->prepare($query);
$statement->bindValue(':show_id', $show_id);
$statement->execute();
$show = $statement->fetch(PDO::FETCH_ASSOC);
$statement->closeCursor();
?>
<!DOCTYPE html>
<html>
<!-- the head section -->
<link href="https://fonts.googleapis.com/css?family=Lato&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Oswald&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Rubik&display=swap" rel="stylesheet">
<head>
    <title>NETFLIX</title>
    <link rel="stylesheet" type="text/css" href="sass/main.css">
</head>
<!-- the body section -->
<body>
    <header><h1>NETFLIX</h1></header>
    <main>
        <h1>Edit Show</h1>
        <form action="edit_show.php" method="post" enctype="multipart/form-data"
              id="add_show_form">
            <input type="hidden" name="original_image" value="<?php echo $record['image']; ?>" />
            <input type="hidden" name="show_id"
                   value="<?php echo $show['showID']; ?>">
            <label>Actor ID:</label>
            <input type="actor_id" name="actor_id"
                   value="<?php echo $show['actorID']; ?>">
                   
            <br>
            <label>Name:</label>
            <input type="input" name="name"
                   value="<?php echo $show['name']; ?>">

            <br>
            <label>Description:</label>
            <input type="input" name="description"
                   value="<?php echo $show['description']; ?>">

            <br>
            <label>Release Date:</label>
            <input type="date" name="releaseDate"
                   value="<?php echo $show['releaseDate']; ?>">

            <br>
            <label>Image:</label>
            <input type="file" name="image" accept="image/*" />
            <br>
            <?php if ($show['image'] != "") { ?>
            <p><img src="image_uploads/<?php echo $show['image']; ?>" height="150" /></p>
            <?php } ?>
            <label>&nbsp;</label>
            <input type="submit" value="Save Changes">
            <input type="reset">
            <br>
        </form>
        <p><button><a href="manage_shows.php">Shows</a></button></p>
    </main>
    <footer>
        <p>&copy; <?php echo date("Y"); ?> NETFLIX, Roisin McPhillips.</p>
    </footer>
</body>
</html>
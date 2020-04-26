<?php
require('database.php');
$query = 'SELECT *
          FROM actors
          ORDER BY actorID';
$statement = $db->prepare($query);
$statement->execute();
$actors = $statement->fetchAll();
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
    <link rel="stylesheet" type="text/css" href="./SASS/main.css">
</head>
<!-- the body section -->
<body>
    <header><h1>NETFLIX</h1></header>

    <main>
        <h1>Add a Show</h1>
        <form action="add_show.php" method="post" enctype="multipart/form-data"
              id="add_show_form">
            <label>Actor:</label>
            <select name="actor_id">
            <?php foreach ($actors as $actor) : ?>
                <option value="<?php echo $actor['actorID']; ?>">
                    <?php echo $actor['actorName']; ?>
                </option>
            <?php endforeach; ?>
            </select>
            <br>

            <label>Name:</label>
            <input type="input" name="name"  pattern="[A-Za-z].{5,}" 
            title="Must contain 5 or more characters that are of at least one uppercase and lowercase letter" required>
            <br>

            <label>Description:</label>
            <input type="input" name="description" title="Must be text" required>
            <br>

            <label>Release date (yy-mm-dd):</label>
            <input type="date" name="releaseDate" title="Must be of date type" required>
            <br>

            <label>Image:</label>
            <input type="file" name="image" accept="image/*" />
            <br>

            <label>&nbsp;</label>
            <input type="submit" value="Add Show">
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
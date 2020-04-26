<?php
require('database.php');
$query = 'SELECT *
          FROM categories
          ORDER BY categoryID';
$statement = $db->prepare($query);
$statement->execute();
$categories = $statement->fetchAll();
$statement->closeCursor();
?>
<!DOCTYPE html>
<html>
<!-- the head section -->
<link href="https://fonts.googleapis.com/css?family=Lato&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Oswald&display=swap" rel="stylesheet">
<head>
    <title>NETFLIX</title>
    <link rel="stylesheet" type="text/css" href="./SASS/main.css">
</head>
<!-- the body section -->
<body>
    <header><h1>NETFLIX</h1></header>

    <main>
        <h1>Add a Film</h1>
        <form action="add_record.php" method="post" enctype="multipart/form-data"
              id="add_record_form">
            <label>Genre:</label>
            <select name="category_id">
            <?php foreach ($categories as $category) : ?>
                <option value="<?php echo $category['categoryID']; ?>">
                    <?php echo $category['categoryName']; ?>
                </option>
            <?php endforeach; ?>
            </select>
            <br>

            <label>Name:</label>
            <input type="input" name="name" pattern="[A-Za-z].{5,}" 
            title="Must contain 5 or more characters that are of at least one uppercase and lowercase letter" required>
            <br>

            <label>Description:</label>
            <input type="input" name="description" title="Must be text" required>
            <br>

            <label>Cast:</label>
            <input type="input" name="cast" title="Must be text" required>
            <br>

            <label>Release date (yy-mm-dd):</label>
            <input type="date" name="releaseDate" title="Must be of date type" required>
            <br>

            <label>Price:</label>
            <input type="input" name="price" required>
            <br>

            <label>Image:</label>
            <input type="file" name="image" accept="image/*" required/>
            <br>
            <label>&nbsp;</label>
            <input type="submit" value="Add Film">
            <input type="reset">
            <br>
        </form>
        <p><button><a href="manage_films.php">Films</a></button></p>
    </main>
    <footer>
        <p>&copy; <?php echo date("Y"); ?> NETFLIX, Roisin McPhillips.</p>
    </footer>
</body>
</html>
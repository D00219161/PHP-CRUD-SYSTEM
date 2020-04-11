<?php
    require_once('database.php');
    // Get all actors
    $query = 'SELECT * FROM actors
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
<head>
    <title>NETFLIX</title>
    <link rel="stylesheet" type="text/css" href="./SASS/main.css">
</head>
<!-- the body section -->
<body>
    <header>
    <h1>NETFLIX</h1>
</header>
    <main>
    <h1>Actors</h1>
    <table>
        <tr>
            <th>Name</th>
            <th>&nbsp;</th>
        </tr>
        <!-- Retrieve data as an associative array and output as a foreach loop  -->
        <?php foreach ($actors as $actor) : ?>
        <tr>
            <td><?php echo $actor['actorName']; ?></td>
            <td>
                <form action="delete_actor.php" method="post"
                      id="delete_show_form">
                    <input type="hidden" name="actor_id"
                           value="<?php echo $actor['actorID']; ?>">
                    <input type="submit" value="Delete">
                </form>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
    <br>
    <h2>Add an Actor</h2>
    <form action="add_actor.php" method="post"
          id="add_actor_form">
        <label>Name:</label>
        <input type="input" name="name" required>
        <input id="add_actor_button" type="submit" value="Add">
    </form>
    <br>
    <p><button><a href="show.php">Shows</a></button></p>
    </main>
    <footer>
        <p>&copy; <?php echo date("Y"); ?> NETFLIX, Roisin McPhillips.</p>
    </footer>
</body>
</html>
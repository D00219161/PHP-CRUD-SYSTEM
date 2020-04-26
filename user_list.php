<?php
    require_once('database.php');
    // Get all actors
    $query = 'SELECT * FROM users
              ORDER BY id';
    $statement = $db->prepare($query);
    $statement->execute();
    $users = $statement->fetchAll();
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
    <header>
    <h1>NETFLIX</h1>
</header>
    <main>
    <h1>Users</h1>
    <table>
        <tr>
            <th>Name</th>
            <th>&nbsp;</th>
        </tr>
        <!-- Retrieve data as an associative array and output as a foreach loop  -->
        <?php foreach ($users as $user) : ?>
        <tr>
            <td><?php echo $user['username']; ?></td>
        </tr>
        <?php endforeach; ?>
    </table>
    <p><button><a href="display_users.php">Users</a></button></p>
    </main>
    <footer>
        <p>&copy; <?php echo date("Y"); ?> NETFLIX, Roisin McPhillips.</p>
    </footer>
</body>
</html>
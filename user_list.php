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
            <td><?php echo $user['userName']; ?></td>
            <td>
                <form action="delete_user.php" method="post"
                      id="delete_user_form">
                    <input type="hidden" name="user_id"
                           value="<?php echo $user['id']; ?>">
                    <input type="submit" value="Delete">
                </form>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
    <p><button><a href="display_users.php">Shows</a></button></p>
    </main>
    <footer>
        <p>&copy; <?php echo date("Y"); ?> NETFLIX, Roisin McPhillips.</p>
    </footer>
</body>
</html>
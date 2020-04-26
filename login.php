<?php

//login.php

/**
 * Start the session.
 */
session_start();

/**
 * Include ircmaxell's password_compat library.
 */
require 'libary-folder/password.php';

/**
 * Include our MySQL connection.
 */
require 'login_connect.php';


//If the POST var "login" exists (our submit button), then we can
//assume that the user has submitted the login form.
if(isset($_POST['login'])){
    
    //Retrieve the field values from our login form.
    $username = !empty($_POST['username']) ? trim($_POST['username']) : null;
    $passwordAttempt = !empty($_POST['password']) ? trim($_POST['password']) : null;
    $email = !empty($_POST['email']) ? trim($_POST['email']) : null;
    
    //Retrieve the user account information for the given username.
    $sql = "SELECT id, username, password, email FROM users WHERE username = :username";
    $stmt = $pdo->prepare($sql);
    
    //Bind value.
    $stmt->bindValue(':username', $username);
    
    //Execute.
    $stmt->execute();
    
    //Fetch row.
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    
    //If $row is FALSE.
    if($user === false){
        //Could not find a user with that username!
        //PS: You might want to handle this error in a more user-friendly manner!
        die('Incorrect username / password combination!');
    } else{
        //User account found. Check to see if the given password matches the
        //password hash that we stored in our users table.
        
        //Compare the passwords.
        $validPassword = password_verify($passwordAttempt, $user['password']);
        
        //If $validPassword is TRUE, the login has been successful.
        if($validPassword){
            
            //Provide the user with a login session.
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['logged_in'] = time();
            
            //Redirect to our protected page, which we called manage_films.php
            header('Location: manage_films.php'); 
            exit;
            
        } else{
            //$validPassword was FALSE. Passwords do not match.
            die('Incorrect username / password combination!');
        }
    }
}
 
?>
<!DOCTYPE html>
<html>
<link href="https://fonts.googleapis.com/css?family=Lato&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Oswald&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Rubik&display=swap" rel="stylesheet">
    <head>
        <meta charset="UTF-8">
        <title>Login Please</title>
        <link rel="stylesheet" type="text/css" href="./SASS/main.css">
    </head>
    <body>
        <h1>Login Please</h1>
        <form action="login.php" method="post">

        <label for="username">Username</label>
            <input type="text" id="username" name="username" title="Must contain characters that are of at least one uppercase and lowercase letter" required>
            <br>

            <label for="password">Password</label>
            <input type="password" id="password" name="password" title="Must be text(Upper & Lower) and numbers" required>
            <!-- An element to toggle between password visibility -->
            <input type="checkbox" onclick="myFunction()">Show Password Entered
            <br>

            <label for="email">Email</label>
            <input type="text" id="email" name="email" title="Must be text" required>
            <br>

            <input type="submit" name="login" value="Login">
            <input type="reset">
            <br>
        </form>
        <script>
        function myFunction() {
  var x = document.getElementById("password");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}
</script>
<footer>
        <p>&copy; <?php echo date("Y"); ?> NETFLIX, Roisin McPhillips.</p>
    </footer>
</body>
</html>
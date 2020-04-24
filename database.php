<?php
    $dsn = 'mysql:host=localhost;dbname=server_side_development_roisin';
    $username = 'D00219161';
    $password = 'Meninblack1416';
    try {
        $db = new PDO($dsn, $username, $password);
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        include('database_error.php');
        exit();
    }
?>
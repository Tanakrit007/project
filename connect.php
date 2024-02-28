<?php
$serverName = 'localhost';
$userName = 'root';
$userPassword = '';
$dbname = 'project';

try {
    $conn = new PDO(
        "mysql:host=$serverName;dbname=$dbname;charset=UTF8",
         $userName,
         $userPassword
    );

    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo 'You are now connect to the ';
} catch (PDOException $e) {
    echo 'Sorry! You cannot connect to the  ' . $e->getMessage();
}
?>
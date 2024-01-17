<?php
session_start();

include 'dbconn.php'; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];

    $statement = $pdo->prepare("SELECT * FROM inlog WHERE email = :email AND password = :password");
    $statement->bindParam(':email', $email);
    $statement->bindParam(':password', $password);
    $statement->execute();

    $user = $statement->fetch(PDO::FETCH_ASSOC);

    // Check of de ingevoerde gegevens kloppen
    if ($statement->rowCount() > 0) {
        $_SESSION['user_id'] = $user_id; 
        $_SESSION['username'] = $username;
        $_SESSION['logged_in'] = true;
        header("Location: index.html");
        exit();
    } else {
        echo "Ongeldige gebruikersnaam en/of wachtwoord";
    }
    
}

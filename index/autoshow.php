<?php
$host = 'localhost:3306';
$dbnaam = 'trello';
$gebruiker = 'root';
$wachtwoord = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connectie mislukt: " . $e->getMessage());
}

if (isset($_POST['register'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    $query = "INSERT INTO users (username, password) VALUES (?, ?)";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$username, $password]);
    
}

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    $query = "SELECT * FROM users WHERE username = ? AND password = ?";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$username, $password]);
    
    if ($stmt->rowCount() == 1) {
    } else {
    }
}

if (isset($_POST['order'])) {
    $product_id = $_POST['product_id']; 
    $user_id = $_SESSION['user_id']; 
    
    $query = "INSERT INTO orders (user_id, product_id) VALUES (?, ?)";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$user_id, $product_id]);
    
}

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    
    $query = "SELECT products.name, orders.date
              FROM orders
              JOIN products ON orders.product_id = products.id
              WHERE orders.user_id = ?";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$user_id]);
    
}
?>

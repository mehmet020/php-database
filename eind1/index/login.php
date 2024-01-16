<?php

//database connecten

$host = 'localhost:3307';
$db   = 'RAC';
$user = 'root';
$pass = '';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];
try 
{
     $pdo = new PDO($dsn, $user, $pass, $options);
    
} 
catch (\PDOException $e) 
{
     throw new \PDOException($e->getMessage(), (int)$e->getCode());
}
// tot hier

?>

<?php

if(isset($_POST["toevoegen"])) {
    $email = $_POST['email'];
    $password = $_POST['password'];


    $data = [
        'email' => $email,
        'password' => $password,
    ];


    $sql = "INSERT INTO inlog (email, password
    ) VALUES (:email, :password )"; 
    
    $stmt=$pdo->prepare($sql);
    $stmt->execute($data);

  }


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="log.css">
</head>


<body>


<form method="POST" action="">
    <h1>Login</h1>

<input type="text" name="email" placeholder="email" required> <br>

<input type="text" name="password" placeholder="password" required> <br>

<a href="winkelmand.html" type="submit">Login</a><br>

<div class="booknow2">
<a href="acc.html"><b>Geen account? druk hier</b></a>
     
    </div>

</form>

</body>
</html>
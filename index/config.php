<?php

$db['host'] = "localhost:3307";
$db['user'] = "root";
$db['pass'] = "";
$db['name'] = "rac";

try {
    $dsn = "mysql:host={$db['host']};dbname={$db['name']};charset=utf8";
    $pdo = new PDO($dsn, $db['user'], $db['pass']);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
?>

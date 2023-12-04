<?php
class Database {
    public $pdo;

    public function __construct($db = "test", $host = "localhost3307", $user = "root", $pass = "") {
        try {
            $this->pdo = new PDO("mysql:host=$host; dbname=$db", $user, $pass);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }
    function select($id = null) {

        $query = "SELECT * FROM gegevens";
        if ($id !== null) {
            $query .= " WHERE id = :id";
        }
        $stmt = $this->pdo->prepare($query);
        if ($id !== null) {
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        }
        $stmt->execute();
        $resultaat = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach ($resultaat as $row) {
            echo '<div>';
            echo '<p>ID: ' . $row['id'] . '</p>';
            echo '<p>Name: ' . $row['naam'] . '</p>';
            echo '<p>Email: ' . $row['Email'] . '</p>';
            echo '<p>wachtwoord: ' . $row['wachtwoord'] . '</p>';
            echo '<a href="edit.php"><button>Edit</button></a>';
            echo '<a href="delete.php"><button>Delete</button></a>';
            echo '</div>';
        }
        return $resultaat;
    }
}
$database = new Database();
$database->select();
?>

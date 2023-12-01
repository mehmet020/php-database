<?php
class Database {
    private $pdo;
    public function __construct($host, $dbname, $username, $password) {
        $this->pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function insertData($column1, $column2, $column3) {
        try {
            $sql = "INSERT INTO jouw_tabel (kolom1, kolom2, kolom3) VALUES (:column1, :column2, :column3)";

            $stmt = $this->pdo->prepare($sql);

            $stmt->bindParam(':column1', $column1);
            $stmt->bindParam(':column2', $column2);
            $stmt->bindParam(':column3', $column3);

            $stmt->execute();

            echo "Data succesvol toegevoegd aan de tabel.";
        } catch (PDOException $e) {
            echo "Fout bij het toevoegen van data: " . $e->getMessage();
        }
    }
}

$database = new Database('jouw_host', 'jouw_database', 'jouw_gebruikersnaam', 'jouw_wachtwoord');
$database->insertData('waarde1', 'waarde2', 'waarde3');

?>
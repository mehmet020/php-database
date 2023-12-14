<?php
class Database {
    private $host = "localhost:3307";
    private $gebruikersnaam = "root";
    private $wachtwoord = "";
    private $database = "RAC";
    private $verbinding;

    public function __construct() {
        $this->verbinding = new mysqli($this->host, $this->gebruikersnaam, $this->wachtwoord, $this->database);

        if ($this->verbinding->connect_error) {
            die("Verbinding mislukt: " . $this->verbinding->connect_error);
        }
    }

    public function sluitVerbinding() {
        $this->verbinding->close();
    }

    public function queryUitvoeren($sql) {
        return $this->verbinding->query($sql);
    }
}

class Verhuur {
    private $database;

    public function __construct($database) {
        $this->database = $database;
    }

    public function krijgVerhuurGeschiedenis() {
        $sql = "SELECT Verhuringen.VerhuurID, Verhuringen.Verhuurdatum, Klanten.Naam AS Klantnaam, Autos.Merk, Autos.Model, Verhuringen.Kosten
                FROM Verhuringen
                JOIN Klanten ON Verhuringen.KlantID = Klanten.KlantID
                JOIN Autos ON Verhuringen.AutoID = Autos.AutoID
                ORDER BY Verhuringen.Verhuurdatum DESC";

        $resultaat = $this->database->queryUitvoeren($sql);

        if ($resultaat->num_rows > 0) {
            return $resultaat->fetch_all(MYSQLI_ASSOC);
        } else {
            return [];
        }
    }

    public function verhuurAuto($klantID, $autoID, $huurperiode) {
        $tariefPerDag = 50; // Vervang dit door het echte tarief per dag

        $kosten = $tariefPerDag * $huurperiode;

        $verhuurdatum = date('Y-m-d');
        $sql = "INSERT INTO Verhuringen (KlantID, AutoID, Verhuurdatum, Huurperiode, Kosten) VALUES ('$klantID', '$autoID', '$verhuurdatum', '$huurperiode', '$kosten')";
        $this->database->queryUitvoeren($sql);
        
    }
}

$database = new Database();
$verhuur = new Verhuur($database);

// Verwerk het formulier als het is verzonden
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $klantID = $_POST['klant_id'];
    $autoID = $_POST['auto_id'];
    $huurperiode = $_POST['huurperiode'];

    // Voer validatie uit indien nodig

    // Roep de methode aan om een auto te verhuren
    $verhuur->verhuurAuto($klantID, $autoID, $huurperiode);
}

$verhuurGeschiedenis = $verhuur->krijgVerhuurGeschiedenis();

$database->sluitVerbinding();
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
    body{background-image:url(1.jpg);
    background-repeat: no-repeat;
    background-attachment: fixed;
    background-size: 100%;
    color: white;
    align-items: center;
    }
    </style>
    <title>Verhuurgeschiedenis</title>
</head>

<body>
    <h2>Verhuurgeschiedenis</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Datum</th>
            <th>Klantnaam</th>
            <th>Auto</th>
            <th>Kosten</th>
        </tr>
        <?php foreach ($verhuurGeschiedenis as $verhuur) : ?>
            <tr>
                <td><?= $verhuur['VerhuurID'] ?></td>
                <td><?= $verhuur['Verhuurdatum'] ?></td>
                <td><?= $verhuur['Klantnaam'] ?></td>
                <td><?= $verhuur['Merk'] . ' ' . $verhuur['Model'] ?></td>
                <td><?= $verhuur['Kosten'] ?></td>
            </tr>
        <?php endforeach; ?>
    </table>

    <hr>

    <h2>Auto verhuren</h2>
    <form method="post" action="">
        <label for="klant_id">Klant ID:</label>
        <input type="text" name="klant_id" required>

        <label for="auto_id">Auto ID:</label>
        <input type="text" name="auto_id" required>

        <label for="huurperiode">Huurperiode (dagen):</label>
        <input type="text" name="huurperiode" required>

        <button type="submit">Verhuren</button>
    </form>
</body>
</html>
<?php
// Verwerk het formulier en voeg de auto toe aan de database of sla de gegevens op zoals nodig.

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $merk = $_POST["merk"];
    $model = $_POST["model"];
    $beschikbaarheid = $_POST["beschikbaarheid"];

    // Voer hier de code uit om de gegevens in de database op te slaan of te verwerken.
    // Bijvoorbeeld: voeg de gegevens toe aan een MySQL-database.

    // Stuur de gebruiker naar een bedankpagina of een andere locatie.
    header("Location: bedankt.php");
    exit();
}
?>

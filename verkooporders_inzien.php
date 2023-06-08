<?php

require_once 'classes/Database.php';
include 'navbar.php';
// Maak de verbinding met de database
$database = new Database();
$conn = $database->getConnection();

// Query om de verkooporders op te halen
$query = "SELECT verkooporder.verkOrdId, verkooporder.klantId, klanten.klantNaam, verkooporder.artId, artikelen.artOmschrijving, verkooporder.verkOrdDatum, verkooporder.verkOrdBestAantal, verkooporder.verkOrdStatus 
          FROM verkooporder
          INNER JOIN klanten ON verkooporder.klantId = klanten.klantId
          INNER JOIN artikelen ON verkooporder.artId = artikelen.artId
          ORDER BY verkooporder.verkOrdDatum DESC";

$stmt = $conn->prepare($query);
$stmt->execute();

// Haal de verkooporders op
$verkooporders = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Sluit de databaseverbinding
$conn = null;

// Toon de verkooporders
if (!empty($verkooporders)) {
    echo "<h1>Verkoopordergegevens</h1>

    <h2>Bestaande verkooporders</h2>";
    echo "<table>";
    echo "<tr><th>Verkooporder ID</th><th>Klant</th><th>Artikel</th><th>Verkoopdatum</th><th>Bestelhoeveelheid</th><th>Status</th><th>Acties</th><th>Verwijderen</th></tr>";

    foreach ($verkooporders as $verkooporder) {
        echo "<tr>";
        echo "<td>{$verkooporder['verkOrdId']}</td>";
        echo "<td>{$verkooporder['klantId']} - {$verkooporder['klantNaam']}</td>";
        echo "<td>{$verkooporder['artId']} - {$verkooporder['artOmschrijving']}</td>";
        echo "<td>{$verkooporder['verkOrdDatum']}</td>";
        echo "<td>{$verkooporder['verkOrdBestAantal']}</td>";
        echo "<td>{$verkooporder['verkOrdStatus']}</td>";
        echo "<td><a href='edit_verkooporder.php?verkOrdId={$verkooporder['verkOrdId']}'>Bewerken</a></td>";
        echo "<td><a href='delete_verkooporder.php?verkOrdId={$verkooporder['verkOrdId']}' onclick='return confirm(\"Weet je zeker dat je deze verkooporder wilt verwijderen?\")'>Verwijderen</a></td>";
        echo "</tr>";
    }

    echo "</table>";
} else {
    echo "Geen verkooporders gevonden.";
}

?>

<a href="insert_verkooporder.php">Verkooporder aanmaken</a>
<link rel="stylesheet" href="styles.css">

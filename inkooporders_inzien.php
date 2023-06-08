<?php

require_once 'classes/Database.php';
include 'navbar.php';
// Create a connection to the database
$database = new Database();
$conn = $database->getConnection();

// Query to retrieve inkooporders
$query = "SELECT inkooporder.inkId, inkooporder.levId, leveranciers.levNaam, inkooporder.artId, artikelen.artOmschrijving, inkooporder.inkOrdDatum, inkooporder.inkOrdBestAantal, inkooporder.inkOrdStatus 
          FROM inkooporder
          INNER JOIN leveranciers ON inkooporder.levId = leveranciers.levId
          INNER JOIN artikelen ON inkooporder.artId = artikelen.artId
          ORDER BY inkooporder.inkId";

$stmt = $conn->prepare($query);
$stmt->execute();

// Fetch the inkooporders
$inkooporders = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Close the database connection
$conn = null;

// Display the inkooporders
if (!empty($inkooporders)) {
    echo "<h1>Inkoopordersgegevens</h1>

    <h2>Bestaande inkooporders</h2>";
    echo "<table>";
    echo "<tr><th>Inkooporder ID</th><th>Leverancier</th><th>Artikel</th><th>Inkoopdatum</th><th>Bestelhoeveelheid</th><th>Status</th><th>Acties</th><th>Verwijderen</th></tr>";

    foreach ($inkooporders as $inkooporder) {
        echo "<tr>";
        echo "<td>{$inkooporder['inkId']}</td>";
        echo "<td>{$inkooporder['levId']} - {$inkooporder['levNaam']}</td>";
        echo "<td>{$inkooporder['artId']} - {$inkooporder['artOmschrijving']}</td>";
        echo "<td>{$inkooporder['inkOrdDatum']}</td>";
        echo "<td>{$inkooporder['inkOrdBestAantal']}</td>";
        echo "<td>{$inkooporder['inkOrdStatus']}</td>";
        echo "<td><a href='edit_inkooporder.php?inkId={$inkooporder['inkId']}'>Bewerken</a></td>";
        echo "<td><a href='delete_inkooporder.php?inkId={$inkooporder['inkId']}' onclick='return confirm(\"Weet je zeker dat je deze inkooporder wilt verwijderen?\")'>Verwijderen</a></td>";
        echo "</tr>";
    }

    echo "</table>";
} else {
    echo "Geen inkooporders gevonden.";
}

?>

<a href="insert_inkooporder.php">Inkooporder aanmaken</a>
<link rel="stylesheet" href="styles.css">

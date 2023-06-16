<?php
require_once 'classes/Database.php';

// Controleer of de klantId aanwezig is in de URL
if (isset($_GET['id'])) {
    $klantId = $_GET['id'];

    // Verbind met de database
    $database = new Database();
    $conn = $database->getConnection();

    // Verwijder de bijbehorende verkooporders van de klant
    $verkoopQuery = "DELETE FROM verkooporder WHERE klantId = :klantId";
    $verkoopStmt = $conn->prepare($verkoopQuery);
    $verkoopStmt->bindParam(":klantId", $klantId);
    $verkoopStmt->execute();

    // Bereid de SQL-query voor om de klant te verwijderen
    $klantQuery = "DELETE FROM klanten WHERE klantId = :klantId";
    $klantStmt = $conn->prepare($klantQuery);
    $klantStmt->bindParam(":klantId", $klantId);

    // Voer de query uit om de klant te verwijderen
    if ($klantStmt->execute()) {
        // Redirect naar klanten_inzien.php na het verwijderen
        header("Location: klanten_inzien.php");
        exit;
    } else {
        echo "Er is een fout opgetreden bij het verwijderen van de klant.";
        exit;
    }
} else {
    // Het klantId is niet opgegeven in de URL, redirect naar klanten_inzien.php
    header("Location: klanten_inzien.php");
    exit;
}
?>

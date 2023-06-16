<?php
require_once 'classes/Database.php';

// Controleer of het artId aanwezig is in de URL
if (isset($_GET['id'])) {
    $artId = $_GET['id'];

    // Verbind met de database
    $database = new Database();
    $conn = $database->getConnection();

    // Verwijder de bijbehorende artikelprijzen van het artikel
    $prijsQuery = "DELETE FROM artikelprijs WHERE artId = :artId";
    $prijsStmt = $conn->prepare($prijsQuery);
    $prijsStmt->bindParam(":artId", $artId);
    $prijsStmt->execute();

    // Bereid de SQL-query voor om het artikel te verwijderen
    $artikelQuery = "DELETE FROM artikelen WHERE artId = :artId";
    $artikelStmt = $conn->prepare($artikelQuery);
    $artikelStmt->bindParam(":artId", $artId);

    // Voer de query uit om het artikel te verwijderen
    if ($artikelStmt->execute()) {
        // Redirect naar artikelen_inzien.php na het verwijderen
        header("Location: artikelen_inzien.php");
        exit;
    } else {
        echo "Er is een fout opgetreden bij het verwijderen van het artikel.";
        exit;
    }
} else {
    // Het artId is niet opgegeven in de URL, redirect naar artikelen_inzien.php
    header("Location: artikelen_inzien.php");
    exit;
}
?>

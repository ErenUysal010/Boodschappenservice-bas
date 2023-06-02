<?php
require_once 'classes/Database.php';

// Controleer of de verkOrdId aanwezig is in de URL
if (isset($_GET['verkOrdId'])) {
    $verkOrdId = $_GET['verkOrdId'];

    // Verbind met de database
    $database = new Database();
    $conn = $database->getConnection();

    // Bereid de SQL-query voor om de verkooporder te verwijderen
    $query = "DELETE FROM verkooporder WHERE verkOrdId = :verkOrdId";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(":verkOrdId", $verkOrdId);

    // Voer de query uit om de verkooporder te verwijderen
    if ($stmt->execute()) {
        // Redirect naar verkooporders_inzien.php na het verwijderen
        header("Location: verkooporders_inzien.php");
        exit;
    } else {
        echo "Er is een fout opgetreden bij het verwijderen van de verkooporder.";
        exit;
    }
} else {
    // Het verkOrdId is niet opgegeven in de URL, redirect naar verkooporders_inzien.php
    header("Location: verkooporders_inzien.php");
    exit;
}
?>

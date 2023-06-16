<?php
require_once 'classes/Database.php';

// Controleer of de inkId aanwezig is in de URL
if (isset($_GET['inkId'])) {
    $inkId = $_GET['inkId'];

    // Verbind met de database
    $database = new Database();
    $conn = $database->getConnection();

    // Bereid de SQL-query voor om de inkooporder te verwijderen
    $query = "DELETE FROM inkooporder WHERE inkId = :inkId";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(":inkId", $inkId);

    // Voer de query uit om de inkooporder te verwijderen
    if ($stmt->execute()) {
        // Redirect naar inkooporders_inzien.php na het verwijderen
        header("Location: inkooporders_inzien.php");
        exit;
    } else {
        echo "Er is een fout opgetreden bij het verwijderen van de inkooporder.";
        exit;
    }
} else {
    // Het inkId is niet opgegeven in de URL, redirect naar inkooporders_inzien.php
    header("Location: inkooporders_inzien.php");
    exit;
}
?>

<?php
// Inclusief de klantklasse
require_once 'classes/Klant.php';

// Controleer of de klant ID aanwezig is in de URL
if (isset($_GET['id'])) {
    $klantId = $_GET['id'];
    
    // Verwijder de klant uit de database
    if (Klant::deleteKlant($klantId)) {
        echo "Klant succesvol verwijderd.";
        // Redirect naar insert_klant.php
        header("Location: insert_klant.php");
        exit;
    } else {
        echo "Er is een fout opgetreden bij het verwijderen van de klant.";
    }
}

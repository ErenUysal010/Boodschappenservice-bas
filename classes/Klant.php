<?php
// Inclusief de database configuratie
require_once 'Database.php';

class Klant {
    // Voeg een nieuwe klant toe aan de database
    public static function addKlant($naam, $email, $adres, $postcode, $woonplaats) {
        $database = new Database();
        $conn = $database->getConnection();
        
        // Voorbereid SQL-statement
        $stmt = $conn->prepare("INSERT INTO klanten (klantNaam, klantEmail, klantAdres, klantPostcode, klantWoonplaats) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$naam, $email, $adres, $postcode, $woonplaats]);
        
        // Controleren of de query is gelukt
        return $stmt->rowCount() > 0;
    }

    // Haal alle klanten op uit de database
    public static function getKlanten() {
        $database = new Database();
        $conn = $database->getConnection();
        
        // Voorbereid SQL-statement
        $stmt = $conn->prepare("SELECT * FROM klanten");
        
        // Uitvoeren van het SQL-statement
        $stmt->execute();
        
        // Haal resultaten op
        $klanten = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        return $klanten;
    }

    // Haal klant op basis van ID uit de database
    public static function getKlantById($klantId) {
        $database = new Database();
        $conn = $database->getConnection();
        
        // Voorbereid SQL-statement
        $stmt = $conn->prepare("SELECT * FROM klanten WHERE klantId = ?");
        $stmt->execute([$klantId]);
        
        // Haal resultaat op
        $klant = $stmt->fetch(PDO::FETCH_ASSOC);
        
        return $klant;
    }

    // Zoek klanten op basis van zoekterm (klant-ID of klantnaam)
    public static function zoekKlanten($searchTerm) {
        $database = new Database();
        $conn = $database->getConnection();

        // Voorbereid SQL-statement
        $stmt = $conn->prepare("SELECT * FROM klanten WHERE klantId = ? OR klantNaam LIKE ?");
        $searchTerm = "%{$searchTerm}%";
        $stmt->execute([$searchTerm, $searchTerm]);

        // Haal resultaten op
        $klanten = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $klanten;
    }

    // Bewerk klantgegevens in de database
    public static function editKlant($klantId, $naam, $email, $adres, $postcode, $woonplaats) {
        $database = new Database();
        $conn = $database->getConnection();
        
        // Voorbereid SQL-statement
        $stmt = $conn->prepare("UPDATE klanten SET klantNaam = ?, klantEmail = ?, klantAdres = ?, klantPostcode = ?, klantWoonplaats = ? WHERE klantId = ?");
        $stmt->execute([$naam, $email, $adres, $postcode, $woonplaats, $klantId]);
        
        // Controleren of de query is gelukt
        return $stmt->rowCount() > 0;
    }

    // Verwijder klant uit de database
    public static function deleteKlant($klantId) {
        $database = new Database();
        $conn = $database->getConnection();
        
        // Voorbereid SQL-statement
        $stmt = $conn->prepare("DELETE FROM klanten WHERE klantId = ?");
        $stmt->execute([$klantId]);
        
        // Controleren of de query is gelukt
        return $stmt->rowCount() > 0;
    }
}
?>

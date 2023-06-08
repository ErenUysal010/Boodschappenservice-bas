<?php
// Include the database configuration
require_once 'classes/Database.php';

class Leverancier {
    // Add a new leverancier to the database
    public static function addLeverancier($levNaam, $levContact, $levEmail, $levAdres, $levPostcode, $levWoonplaats) {
        $database = new Database();
        $conn = $database->getConnection();
        
        // Prepare SQL statement
        $stmt = $conn->prepare("INSERT INTO leveranciers (levNaam, levContact, levEmail, levAdres, levPostcode, levWoonplaats) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->execute([$levNaam, $levContact, $levEmail, $levAdres, $levPostcode, $levWoonplaats]);
        
        // Check if the query succeeded
        return $stmt->rowCount() > 0;
    }

    // Retrieve all leveranciers from the database
    public static function getLeveranciers() {
        $database = new Database();
        $conn = $database->getConnection();
        
        // Prepare SQL statement
        $stmt = $conn->prepare("SELECT * FROM leveranciers");
        
        // Execute the SQL statement
        $stmt->execute();
        
        // Fetch the results
        $leveranciers = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        return $leveranciers;
    }

    // Retrieve a leverancier by ID from the database
    public static function getLeverancierById($levId) {
        $database = new Database();
        $conn = $database->getConnection();
        
        // Prepare SQL statement
        $stmt = $conn->prepare("SELECT * FROM leveranciers WHERE levId = ?");
        $stmt->execute([$levId]);
        
        // Fetch the result
        $leverancier = $stmt->fetch(PDO::FETCH_ASSOC);
        
        return $leverancier;
    }

    // Edit leverancier data in the database
    public static function editLeverancier($levId, $levNaam, $levContact, $levEmail, $levAdres, $levPostcode, $levWoonplaats) {
        $database = new Database();
        $conn = $database->getConnection();
        
        // Prepare SQL statement
        $stmt = $conn->prepare("UPDATE leveranciers SET levNaam = ?, levContact = ?, levEmail = ?, levAdres = ?, levPostcode = ?, levWoonplaats = ? WHERE levId = ?");
        $stmt->execute([$levNaam, $levContact, $levEmail, $levAdres, $levPostcode, $levWoonplaats, $levId]);
        
        // Check if the query succeeded
        return $stmt->rowCount() > 0;
    }

    // Delete a leverancier from the database
    public static function deleteLeverancier($levId) {
        $database = new Database();
        $conn = $database->getConnection();
        
        // Prepare SQL statement
        $stmt = $conn->prepare("DELETE FROM leveranciers WHERE levId = ?");
        $stmt->execute([$levId]);
        
        // Check if the query succeeded
        return $stmt->rowCount() > 0;
    }
}

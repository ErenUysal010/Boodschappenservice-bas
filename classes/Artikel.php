<?php

require_once 'Database.php';

class Artikel
{
    private $artId;
    private $artOmschrijving;
    private $artInkoop;
    private $artVerkoop;
    private $artVoorraad;
    private $artMinVoorraad;
    private $artMaxVoorraad;
    private $artLocatie;

    public function __construct($artId, $artOmschrijving, $artInkoop, $artVerkoop, $artVoorraad, $artMinVoorraad, $artMaxVoorraad, $artLocatie)
    {
        $this->artId = $artId;
        $this->artOmschrijving = $artOmschrijving;
        $this->artInkoop = $artInkoop;
        $this->artVerkoop = $artVerkoop;
        $this->artVoorraad = $artVoorraad;
        $this->artMinVoorraad = $artMinVoorraad;
        $this->artMaxVoorraad = $artMaxVoorraad;
        $this->artLocatie = $artLocatie;
    }

    public static function addArtikel($artId, $artOmschrijving, $artInkoop, $artVerkoop, $artVoorraad, $artMinVoorraad, $artMaxVoorraad, $artLocatie)
    {
        // Create a new instance of the Database class
        $database = new Database();
        $conn = $database->getConnection();

        // Prepare the SQL statement
        $query = "INSERT INTO artikelen (artId, artOmschrijving, artInkoop, artVerkoop, artVoorraad, artMinVoorraad, artMaxVoorraad, artLocatie) VALUES (:artId, :artOmschrijving, :artInkoop, :artVerkoop, :artVoorraad, :artMinVoorraad, :artMaxVoorraad, :artLocatie)";
        $stmt = $conn->prepare($query);

        // Bind the parameters
        $stmt->bindParam(':artId', $artId);
        $stmt->bindParam(':artOmschrijving', $artOmschrijving);
        $stmt->bindParam(':artInkoop', $artInkoop);
        $stmt->bindParam(':artVerkoop', $artVerkoop);
        $stmt->bindParam(':artVoorraad', $artVoorraad);
        $stmt->bindParam(':artMinVoorraad', $artMinVoorraad);
        $stmt->bindParam(':artMaxVoorraad', $artMaxVoorraad);
        $stmt->bindParam(':artLocatie', $artLocatie);

        // Execute the statement
        if (!$stmt->execute()) {
            // Handle the insert error
            echo "Failed to insert data.";
            return false;
        }

        // Close the database connection
        $conn = null;

        return true;
    }

    public static function getArtikelen()
    {
        // Create a new instance of the Database class
        $database = new Database();
        $conn = $database->getConnection();

        // Prepare the SQL statement
        $query = "SELECT * FROM artikelen";
        $stmt = $conn->prepare($query);

        // Execute the statement
        $stmt->execute();

        // Fetch all rows as associative array
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Close the database connection
        $conn = null;

        // Return the result
        return $result;
    }

    public static function getArtikelById($artId)
    {
        // Create a new instance of the Database class
        $database = new Database();
        $conn = $database->getConnection();

        // Prepare the SQL statement
        $query = "SELECT * FROM artikelen WHERE artId = :artId";
        $stmt = $conn->prepare($query);

        // Bind the parameter
        $stmt->bindParam(':artId', $artId);

        // Execute the statement
        $stmt->execute();

        // Fetch the row as associative array
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        // Close the database connection
        $conn = null;

        // Return the result
        return $result;
    }

    public function getArtId()
    {
        return $this->artId;
    }

    public function getArtOmschrijving()
    {
        return $this->artOmschrijving;
    }

    public function getArtInkoop()
    {
        return $this->artInkoop;
    }

    public function getArtVerkoop()
    {
        return $this->artVerkoop;
    }

    public function getArtVoorraad()
    {
        return $this->artVoorraad;
    }

    public function getArtMinVoorraad()
    {
        return $this->artMinVoorraad;
    }

    public function getArtMaxVoorraad()
    {
        return $this->artMaxVoorraad;
    }

    public function getArtLocatie()
    {
        return $this->artLocatie;
    }
}

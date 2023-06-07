<?php
require_once 'Database.php';

class Verkooporder
{
    private $conn;

    public function __construct()
    {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function createVerkooporder($klantId, $artId, $verkOrdDatum, $verkOrdBestAantal, $verkOrdStatus)
    {
        try {
            $query = "INSERT INTO verkooporder (klantId, artId, verkOrdDatum, verkOrdBestAantal, verkOrdStatus) VALUES (:klantId, :artId, :verkOrdDatum, :verkOrdBestAantal, :verkOrdStatus)";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':klantId', $klantId);
            $stmt->bindParam(':artId', $artId);
            $stmt->bindParam(':verkOrdDatum', $verkOrdDatum);
            $stmt->bindParam(':verkOrdBestAantal', $verkOrdBestAantal);
            $stmt->bindParam(':verkOrdStatus', $verkOrdStatus);
            $stmt->execute();

            return true;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }

    public function verkooporderExists($klantId, $artId)
    {
        try {
            $query = "SELECT COUNT(*) AS count FROM verkooporder WHERE klantId = :klantId AND artId = :artId";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':klantId', $klantId);
            $stmt->bindParam(':artId', $artId);
            $stmt->execute();

            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $count = $row['count'];

            return $count > 0;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }
}
?>

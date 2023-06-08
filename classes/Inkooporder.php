<?php
require_once 'Database.php';

class Inkooporder
{
    private $conn;

    public function __construct()
    {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function createInkooporder($levId, $artId, $inkOrdDatum, $inkOrdBestAantal, $inkOrdStatus)
    {
        try {
            $query = "INSERT INTO inkooporder (levId, artId, inkOrdDatum, inkOrdBestAantal, inkOrdStatus) VALUES (:levId, :artId, :inkOrdDatum, :inkOrdBestAantal, :inkOrdStatus)";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':levId', $levId);
            $stmt->bindParam(':artId', $artId);
            $stmt->bindParam(':inkOrdDatum', $inkOrdDatum);
            $stmt->bindParam(':inkOrdBestAantal', $inkOrdBestAantal);
            $stmt->bindParam(':inkOrdStatus', $inkOrdStatus);
            $stmt->execute();

            return true;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }

    public function inkooporderExists($levId, $artId)
    {
        try {
            $query = "SELECT COUNT(*) AS count FROM inkooporder WHERE levId = :levId AND artId = :artId";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':levId', $levId);
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

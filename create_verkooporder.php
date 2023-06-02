<?php

require_once 'classes/Database.php';

class Verkooporder {
    public static function create_verkooporder($klantId, $artId, $verkOrdDatum, $verkOrdBestAantal, $verkOrdStatus) {
        // Maak verbinding met de database
        $database = new Database();
        $conn = $database->getConnection();

        try {
            // Bereid de SQL-query voor
            $sql = "INSERT INTO verkooporders (klantId, artId, verkOrdDatum, verkOrdBestAantal, verkOrdStatus)
                    VALUES (:klantId, :artId, :verkOrdDatum, :verkOrdBestAantal, :verkOrdStatus)";

            // Bereid de statement voor
            $stmt = $conn->prepare($sql);

            // Bind de waarden aan de parameters
            $stmt->bindParam(':klantId', $klantId);
            $stmt->bindParam(':artId', $artId);
            $stmt->bindParam(':verkOrdDatum', $verkOrdDatum);
            $stmt->bindParam(':verkOrdBestAantal', $verkOrdBestAantal);
            $stmt->bindParam(':verkOrdStatus', $verkOrdStatus);

            // Voer de query uit
            if ($stmt->execute()) {
                echo "Verkooporder is succesvol opgeslagen.";
            } else {
                echo "Fout bij het opslaan van de verkooporder.";
            }
        } catch (PDOException $e) {
            echo "Fout bij het uitvoeren van de query: " . $e->getMessage();
        }
    }
}
?>

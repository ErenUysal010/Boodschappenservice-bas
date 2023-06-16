<?php
// Controleer of het inkId in de URL is opgegeven
if (isset($_GET['inkId'])) {
    $inkId = $_GET['inkId'];

    // Controleer of het formulier is verzonden
    if (isset($_POST['submit'])) {
        // Verwerk het gewijzigde formulier en update de inkooporder in de database

        // Haal de ingevulde gegevens op
        $levId = $_POST['levId'];
        $artId = $_POST['artId'];
        $inkOrdDatum = $_POST['inkOrdDatum'];
        $inkOrdBestAantal = $_POST['inkOrdBestAantal'];
        $inkOrdStatus = $_POST['inkOrdStatus'];

        // Maak verbinding met de database
        require_once 'classes/Database.php';
        $database = new Database();
        $conn = $database->getConnection();

        try {
            // Bereid de SQL-query voor
            $sql = "UPDATE inkooporder
                    SET levId = :levId, artId = :artId, inkOrdDatum = :inkOrdDatum, inkOrdBestAantal = :inkOrdBestAantal, inkOrdStatus = :inkOrdStatus
                    WHERE inkId = :inkId";

            // Bereid de statement voor
            $stmt = $conn->prepare($sql);

            // Bind de waarden aan de parameters
            $stmt->bindParam(':inkId', $inkId);
            $stmt->bindParam(':levId', $levId);
            $stmt->bindParam(':artId', $artId);
            $stmt->bindParam(':inkOrdDatum', $inkOrdDatum);
            $stmt->bindParam(':inkOrdBestAantal', $inkOrdBestAantal);
            $stmt->bindParam(':inkOrdStatus', $inkOrdStatus);

            // Voer de query uit
            if ($stmt->execute()) {
                echo "Inkooporder is succesvol bijgewerkt.";
            } else {
                echo "Fout bij het bijwerken van de inkooporder.";
            }
        } catch (PDOException $e) {
            echo "Fout bij het uitvoeren van de query: " . $e->getMessage();
        }

        // Sluit de databaseverbinding
        $conn = null;

        // Redirect naar de inkooporders_inzien.php-pagina na het bijwerken
        header("Location: inkooporders_inzien.php");
        exit();
    } else {
        // Het formulier is nog niet verzonden, haal de gegevens van de inkooporder op uit de database

        // Maak verbinding met de database
        require_once 'classes/Database.php';
        $database = new Database();
        $conn = $database->getConnection();

        try {
            // Bereid de SQL-query voor
            $sql = "SELECT * FROM inkooporder WHERE inkId = :inkId";

            // Bereid de statement voor
            $stmt = $conn->prepare($sql);

            // Bind de waarde aan de parameter
            $stmt->bindParam(':inkId', $inkId);

            // Voer de query uit
            $stmt->execute();

            // Haal de inkoopordergegevens op
            $inkooporder = $stmt->fetch(PDO::FETCH_ASSOC);

            // Sluit de databaseverbinding
            $conn = null;

            // Controleer of de inkooporder bestaat
            if ($inkooporder) {
                // Toon het wijzigingsformulier met de bestaande inkoopordergegevens
?>
                <!-- Plaats hier het HTML-formulier om de inkooporder te wijzigen -->
                <form method="POST" action="">
                    <!-- Invoervelden voor de inkoopordergegevens -->
                    <!-- Zorg ervoor dat de bestaande waarden worden weergegeven in de invoervelden -->
                    <label for="levId">Leverancier ID:</label>
                    <input type="text" name="levId" value="<?php echo $inkooporder['levId']; ?>">
                    <br />

                    <label for="artId">Artikel ID:</label>
                    <input type="text" name="artId" value="<?php echo $inkooporder['artId']; ?>">
                    <br />

                    <label for="inkOrdDatum">Inkooporder Datum:</label>
                    <input type="text" name="inkOrdDatum" value="<?php echo $inkooporder['inkOrdDatum']; ?>">
                    <br />

                    <label for="inkOrdBestAantal">Bestelhoeveelheid:</label>
                    <input type="text" name="inkOrdBestAantal" value="<?php echo $inkooporder['inkOrdBestAantal']; ?>">
                    <br />

                    <label for="inkOrdStatus">Status:</label>
                    <select name="inkOrdStatus" required>
                        <option value="1">1 - Het artikel in Niet geleverd</option>
                        <option value="2">2 - Het artikel in Wel geleverd</option>
                    </select>
                    <br />
                    <input type="submit" name="submit" value="Wijzigen">
                </form>
<?php
            } else {
                echo "Inkooporder niet gevonden.";
            }
        } catch (PDOException $e) {
            echo "Fout bij het uitvoeren van de query: " . $e->getMessage();
        }
    }
} else {
    // Het inkId is niet opgegeven in de URL, redirect naar de inkooporders_inzien.php-pagina
    header("Location: inkooporders_inzien.php");
    exit();
}
?>
<a href="inkooporders_inzien.php">Inkooporder inzien</a>

<link rel="stylesheet" href="styles.css">
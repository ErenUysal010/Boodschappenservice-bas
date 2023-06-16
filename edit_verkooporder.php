<?php
// Controleer of het verkOrdId in de URL is opgegeven
if (isset($_GET['verkOrdId'])) {
    $verkOrdId = $_GET['verkOrdId'];

    // Controleer of het formulier is verzonden
    if (isset($_POST['submit'])) {
        // Verwerk het gewijzigde formulier en update de verkooporder in de database

        // Haal de ingevulde gegevens op
        $klantId = $_POST['klantId'];
        $artId = $_POST['artId'];
        $verkOrdDatum = $_POST['verkOrdDatum'];
        $verkOrdBestAantal = $_POST['verkOrdBestAantal'];
        $verkOrdStatus = $_POST['verkOrdStatus'];

        // Maak verbinding met de database
        require_once 'classes/Database.php';
        $database = new Database();
        $conn = $database->getConnection();

        try {
            // Bereid de SQL-query voor
            $sql = "UPDATE verkooporder
                    SET klantId = :klantId, artId = :artId, verkOrdDatum = :verkOrdDatum, verkOrdBestAantal = :verkOrdBestAantal, verkOrdStatus = :verkOrdStatus
                    WHERE verkOrdId = :verkOrdId";

            // Bereid de statement voor
            $stmt = $conn->prepare($sql);

            // Bind de waarden aan de parameters
            $stmt->bindParam(':verkOrdId', $verkOrdId);
            $stmt->bindParam(':klantId', $klantId);
            $stmt->bindParam(':artId', $artId);
            $stmt->bindParam(':verkOrdDatum', $verkOrdDatum);
            $stmt->bindParam(':verkOrdBestAantal', $verkOrdBestAantal);
            $stmt->bindParam(':verkOrdStatus', $verkOrdStatus);

            // Voer de query uit
            if ($stmt->execute()) {
                echo "Verkooporder is succesvol bijgewerkt.";
            } else {
                echo "Fout bij het bijwerken van de verkooporder.";
            }
        } catch (PDOException $e) {
            echo "Fout bij het uitvoeren van de query: " . $e->getMessage();
        }

        // Sluit de databaseverbinding
        $conn = null;

        // Redirect naar de verkooporders_inzien.php-pagina na het bijwerken
        header("Location: verkooporders_inzien.php");
        exit();
    } else {
        // Het formulier is nog niet verzonden, haal de gegevens van de verkooporder op uit de database

        // Maak verbinding met de database
        require_once 'classes/Database.php';
        $database = new Database();
        $conn = $database->getConnection();

        try {
            // Bereid de SQL-query voor
            $sql = "SELECT * FROM verkooporder WHERE verkOrdId = :verkOrdId";

            // Bereid de statement voor
            $stmt = $conn->prepare($sql);

            // Bind de waarde aan de parameter
            $stmt->bindParam(':verkOrdId', $verkOrdId);

            // Voer de query uit
            $stmt->execute();

            // Haal de verkoopordergegevens op
            $verkooporder = $stmt->fetch(PDO::FETCH_ASSOC);

            // Sluit de databaseverbinding
            $conn = null;

            // Controleer of de verkooporder bestaat
            if ($verkooporder) {
                // Toon het wijzigingsformulier met de bestaande verkoopordergegevens
?>
                <!-- Plaats hier het HTML-formulier om de verkooporder te wijzigen -->
                <form method="POST" action="">
                    <!-- Invoervelden voor de verkoopordergegevens -->
                    <!-- Zorg ervoor dat de bestaande waarden worden weergegeven in de invoervelden -->
                    <label for="klantId">Klant ID:</label>
                    <input type="text" name="klantId" value="<?php echo $verkooporder['klantId']; ?>">
                    <br />

                    <label for="artId">Artikel ID:</label>
                    <input type="text" name="artId" value="<?php echo $verkooporder['artId']; ?>">
                    <br />

                    <label for="verkOrdDatum">Verkooporder Datum:</label>
                    <input type="text" name="verkOrdDatum" value="<?php echo $verkooporder['verkOrdDatum']; ?>">
                    <br />

                    <label for="verkOrdBestAantal">Bestelhoeveelheid:</label>
                    <input type="text" name="verkOrdBestAantal" value="<?php echo $verkooporder['verkOrdBestAantal']; ?>">
                    <br />

                    <label for="verkOrdStatus">Status:</label>
                    <select name="verkOrdStatus" required>
                        <option value="1">1 - Genoteerd in deze tabel</option>
                        <option value="2">2 - Magazijnmedewerker verzamelt het artikel (picking)</option>
                        <option value="3">3 - Tas met artikel is bij de bezorger</option>
                        <option value="4">4 - Tas met artikel is afgeleverd bij de klant</option>
                    </select>
                    <br />
                    <input type="submit" name="submit" value="Wijzigen">
                </form>
<?php
            } else {
                echo "Verkooporder niet gevonden.";
            }
        } catch (PDOException $e) {
            echo "Fout bij het uitvoeren van de query: " . $e->getMessage();
        }
    }
} else {
    // Het verkOrdId is niet opgegeven in de URL, redirect naar de verkooporders_inzien.php-pagina
    header("Location: verkooporders_inzien.php");
    exit();
}
?>
<a href="verkooporders_inzien.php">Verkooporder inzien</a>
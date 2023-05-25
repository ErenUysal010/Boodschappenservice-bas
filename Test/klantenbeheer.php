<?php
require_once 'databasePDO_connect.php';

// Controleren of het formulier is ingediend
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Actie uitvoeren op basis van de geselecteerde actie
    if ($_POST["actie"] == "toevoegen") {
        // Nieuwe klant toevoegen
        $klantNaam = $_POST["klantNaam"];
        $klantEmail = $_POST["klantEmail"];
        $klantAdres = $_POST["klantAdres"];
        $klantPostcode = $_POST["klantPostcode"];
        $klantWoonplaats = $_POST["klantWoonplaats"];
        //$toevoegDatum = date("Y-m-d");

        try {
            // Het SQL-query voorbereiden en uitvoeren om de nieuwe klant toe te voegen
            $sql = "INSERT INTO klanten (klantNaam, klantEmail, klantAdres, klantPostcode, klantWoonplaats/*, toevoegDatum*/) 
                    VALUES (:klantNaam, :klantEmail, :klantAdres, :klantPostcode, :klantWoonplaats/*, :toevoegDatum*/)";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':klantNaam', $klantNaam);
            $stmt->bindParam(':klantEmail', $klantEmail);
            $stmt->bindParam(':klantAdres', $klantAdres);
            $stmt->bindParam(':klantPostcode', $klantPostcode);
            $stmt->bindParam(':klantWoonplaats', $klantWoonplaats);
            //$stmt->bindParam(':toevoegDatum', $toevoegDatum);
            $stmt->execute();

            echo "Nieuwe klant succesvol toegevoegd!";
        } catch (PDOException $e) {
            echo "Fout bij het toevoegen van de klant: " . $e->getMessage();
        }
    } elseif ($_POST["actie"] == "bewerken") {
        // Klant bewerken
        $klantId = $_POST["klantId"];
        $klantNaam = $_POST["klantNaam"];
        $klantEmail = $_POST["klantEmail"];
        $klantAdres = $_POST["klantAdres"];
        $klantPostcode = $_POST["klantPostcode"];
        $klantWoonplaats = $_POST["klantWoonplaats"];

        try {
            // Het SQL-query voorbereiden en uitvoeren om de klant bij te werken
            $sql = "UPDATE klanten SET klantNaam = :klantNaam, klantEmail = :klantEmail, klantAdres = :klantAdres, klantPostcode = :klantPostcode, klantWoonplaats = :klantWoonplaats WHERE klantId = :klantId";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':klantNaam', $klantNaam);
            $stmt->bindParam(':klantEmail', $klantEmail);
            $stmt->bindParam(':klantAdres', $klantAdres);
            $stmt->bindParam(':klantPostcode', $klantPostcode);
            $stmt->bindParam(':klantWoonplaats', $klantWoonplaats);
            $stmt->bindParam(':klantId', $klantId);
            $stmt->execute();

            echo "Klant succesvol bijgewerkt!";
        } catch (PDOException $e) {
            echo "Fout bij het bijwerken van de klant: " . $e->getMessage();
        }
    } elseif ($_POST["actie"] == "verwijderen") {
        // Klant verwijderen
        $klantId = $_POST["klantId"];

        try {
            // Het SQL-query voorbereiden en uitvoeren om de klant te verwijderen
            $sql = "DELETE FROM klanten WHERE klantId = :klantId";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':klantId', $klantId);
            $stmt->execute();

            echo "Klant succesvol verwijderd!";
        } catch (PDOException $e) {
            echo "Fout bij het verwijderen van de klant: " . $e->getMessage();
        }
    }
}

?>

<!DOCTYPE html>
<html>

<head>
    <title>Klantenbeheer</title>
    <link rel="stylesheet" type="text/css" href="styles.css" />
</head>

<body>

    <div class="Logo">
        <img src="Images/Bas_Logo.png"/>
    </div>

    <h2>Nieuwe klant toevoegen:</h2>
    <form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
        <label for="klantNaam">Naam:</label>
        <input type="text" name="klantNaam" id="klantNaam" required><br>
        <label for="klantEmail">Email:</label>
        <input type="email" name="klantEmail" id="klantEmail" required><br>
        <label for="klantAdres">Adres:</label>
        <input type="text" name="klantAdres" id="klantAdres" required><br>
        <label for="klantPostcode">Postcode:</label>
        <input type="text" name="klantPostcode" id="klantPostcode" required><br>
        <label for="klantWoonplaats">Woonplaats:</label>
        <input type="text" name="klantWoonplaats" id="klantWoonplaats" required><br>
        <input type="hidden" name="actie" value="toevoegen">
        <input type="submit" value="Toevoegen">
    </form>

    <?php
    // De klanten uit de database ophalen en weergeven
    $sql = "SELECT * FROM klanten";
    $stmt = $conn->prepare($sql);
    $stmt->execute();

    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (count($result) > 0) {
        echo "<h2>Klanten:</h2>";
        echo "<table>";
        echo "<tr><th>klantID</th><th>KlantNaam</th><th>KlantEmail</th><th>KlantAdres</th><th>KlantPostcode</th><th>KlantWoonplaats</th><th>Actie</th></tr>";
        //<th>ToevoegDatum</th>

        foreach ($result as $row) {
            echo "<tr>";
            echo "<td>" . $row["klantId"] . "</td>";
            echo "<td>" . $row["klantNaam"] . "</td>";
            echo "<td>" . $row["klantEmail"] . "</td>";
            echo "<td>" . $row["klantAdres"] . "</td>";
            echo "<td>" . $row["klantPostcode"] . "</td>";
            echo "<td>" . $row["klantWoonplaats"] . "</td>";
            //echo "<td>" . $row["toevoegDatum"] . "</td>";
            echo "<td>
                    <form method='post' action='" . $_SERVER["PHP_SELF"] . "'>
                        <input type='hidden' name='klantId' value='" . $row["klantId"] . "'>
                        <input type='hidden' name='klantNaam' value='" . $row["klantNaam"] . "'>
                        <input type='hidden' name='klantEmail' value='" . $row["klantEmail"] . "'>
                        <input type='hidden' name='klantAdres' value='" . $row["klantAdres"] . "'>
                        <input type='hidden' name='klantPostcode' value='" . $row["klantPostcode"] . "'>
                        <input type='hidden' name='klantWoonplaats' value='" . $row["klantWoonplaats"] . "'>
                        <input type='submit' name='actie' value='bewerken'>
                        <input type='submit' name='actie' value='verwijderen' onclick='return confirm(\"Weet je zeker dat je deze klant wilt verwijderen?\")'>
                    </form>
                </td>";
            echo "</tr>";
        }

        echo "</table>";
    }

    // Verbinding met de database sluiten
    $conn = null;
    ?>
</body>

</html>
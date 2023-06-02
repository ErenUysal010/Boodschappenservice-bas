<?php

require_once 'classes/Database.php';

// Create a new instance of the Database class
$database = new Database();
$conn = $database->getConnection();

// Query to retrieve customer data
$query = "SELECT klantId, klantNaam FROM klanten";
$stmt = $conn->prepare($query);
$stmt->execute();

// Fetch the customer data
$klanten = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Query to retrieve article data
$query = "SELECT artId, artOmschrijving FROM artikelen";
$stmt = $conn->prepare($query);
$stmt->execute();

// Fetch the article data
$artikelen = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Close the database connection
$conn = null;

// Form submission handling
if (isset($_POST['submit'])) {
    $klantId = $_POST['klantId'];
    $artId = $_POST['artId'];
    $verkOrdDatum = $_POST['verkOrdDatum'];
    $verkOrdBestAantal = $_POST['verkOrdBestAantal'];
    $verkOrdStatus = $_POST['verkOrdStatus'];

    // Insert the data into the verkooporder table
    $database = new Database();
    $conn = $database->getConnection();

    // Prepare the SQL statement
    $query = "INSERT INTO verkooporder (klantId, artId, verkOrdDatum, verkOrdBestAantal, verkOrdStatus) VALUES (:klantId, :artId, :verkOrdDatum, :verkOrdBestAantal, :verkOrdStatus)";
    $stmt = $conn->prepare($query);

    // Bind the parameters
    $stmt->bindParam(':klantId', $klantId);
    $stmt->bindParam(':artId', $artId);
    $stmt->bindParam(':verkOrdDatum', $verkOrdDatum);
    $stmt->bindParam(':verkOrdBestAantal', $verkOrdBestAantal);
    $stmt->bindParam(':verkOrdStatus', $verkOrdStatus);

    // Execute the statement
    if ($stmt->execute()) {
        // Redirect to success page or display a success message
        header("Location: verkooporders_inzien.php");
        exit;
    } else {
        // Handle the insert error
        echo "Failed to insert data.";
    }

    // Close the database connection
    $conn = null;
}
?>

<!-- HTML Form -->
<a href="index.php">Terug naar hoofdpagina</a>

<form action="insert_verkooporder.php" method="post">
    <!-- Dropdown for klantId -->
    <label for="klantId">Klant:</label>
    <select name="klantId">
        <?php
            foreach ($klanten as $klant) {
                $selected = ($klant['klantId'] == $klantId) ? 'selected' : '';
                echo "<option value='{$klant['klantId']}' $selected>{$klant['klantId']} - {$klant['klantNaam']}</option>";
            }
        ?>
    </select><br><br>

    <!-- Dropdown for artId -->
    <label for="artId">Artikel:</label>
    <select name="artId">
        <?php
            foreach ($artikelen as $artikel) {
                $selected = ($artikel['artId'] == $artId) ? 'selected' : '';
                echo "<option value='{$artikel['artId']}' $selected>{$artikel['artId']} - {$artikel['artOmschrijving']}</option>";
            }
        ?>
    </select><br><br>

    <!-- Rest of the form fields -->
    <label for="verkOrdDatum">Verkoopdatum:</label>
    <input type="text" name="verkOrdDatum" value="<?php echo date('Y-m-d'); ?>"><br><br>

    <label for="verkOrdBestAantal">Bestelhoeveelheid:</label>
    <input type="text" name="verkOrdBestAantal" value=""><br><br>

    <label for="verkOrdStatus">Status:</label>
    <input type="text" name="verkOrdStatus" value=""><br><br>

    <!-- Submit button -->
    <input type="submit" name="submit" value="Opslaan">
</form>
<a href="verkooporders_inzien.php">Verkooporder inzien</a>

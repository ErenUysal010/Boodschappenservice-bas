<?php

require_once 'classes/Database.php';
include 'navbar.php';
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
$errors = [];

if (isset($_POST['submit'])) {
    $klantId = $_POST['klantId'];
    $artId = $_POST['artId'];
    $verkOrdDatum = $_POST['verkOrdDatum'];
    $verkOrdBestAantal = $_POST['verkOrdBestAantal'];
    $verkOrdStatus = $_POST['verkOrdStatus'];

    // Validate form fields
    if (empty($klantId)) {
        $errors[] = "Klant is verplicht.";
    }

    if (empty($artId)) {
        $errors[] = "Artikel is verplicht.";
    }

    if (empty($verkOrdDatum)) {
        $errors[] = "Datum is verplicht.";
    }

    if (empty($verkOrdBestAantal)) {
        $errors[] = "Bestelhoeveelheid is verplicht.";
    }

    if (empty($verkOrdStatus)) {
        $errors[] = "Status is verplicht.";
    }

    if (empty($errors)) {
        // Check if the verkooporder already exists
        $database = new Database();
        $conn = $database->getConnection();

        $query = "SELECT COUNT(*) FROM verkooporder WHERE klantId = :klantId AND artId = :artId";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':klantId', $klantId);
        $stmt->bindParam(':artId', $artId);
        $stmt->execute();

        $count = $stmt->fetchColumn();

        if ($count > 0) {
            $errors[] = "Verkooporder bestaat al.";
        } else {
            // Insert the data into the verkooporder table
            $query = "INSERT INTO verkooporder (klantId, artId, verkOrdDatum, verkOrdBestAantal, verkOrdStatus) VALUES (:klantId, :artId, :verkOrdDatum, :verkOrdBestAantal, :verkOrdStatus)";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':klantId', $klantId);
            $stmt->bindParam(':artId', $artId);
            $stmt->bindParam(':verkOrdDatum', $verkOrdDatum);
            $stmt->bindParam(':verkOrdBestAantal', $verkOrdBestAantal);
            $stmt->bindParam(':verkOrdStatus', $verkOrdStatus);

            if ($stmt->execute()) {
                // Redirect to success page or display a success message
                header("Location: verkooporders_inzien.php");
                exit();
            } else {
                $errors[] = "Er is een fout opgetreden bij het toevoegen van de verkooporder.";
            }
        }

        // Close the database connection
        $conn = null;
    }
}

?>

<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="styles.css">
    <title>Verkooporder</title>
</head>

<body>
    <h1>Verkooporder</h1>

    <h2>Nieuwe verkooporder toevoegen</h2>

    <form method="post" action="insert_verkooporder.php">
        <label for="klantId">Klant:</label>
        <select name="klantId" required>
            <option value="">Kies een klant</option>
            <?php foreach ($klanten as $klant) { ?>
                <option value="<?php echo $klant['klantId']; ?>"><?php echo $klant['klantNaam']; ?></option>
            <?php } ?>
        </select>
        <br>

        <label for="artId">Artikel:</label>
        <select name="artId" required>
            <option value="">Kies een artikel</option>
            <?php foreach ($artikelen as $artikel) { ?>
                <option value="<?php echo $artikel['artId']; ?>"><?php echo $artikel['artOmschrijving']; ?></option>
            <?php } ?>
        </select>
        <br>

        <label for="verkOrdDatum">Datum:</label>
        <input type="date" name="verkOrdDatum" value="<?php echo date('Y-m-d'); ?>" required>
        <br>

        <label for="verkOrdBestAantal">Bestelhoeveelheid:</label>
        <input type="number" name="verkOrdBestAantal" required>
        <br>

        <label for="verkOrdStatus">Status:</label>
        <select name="verkOrdStatus" required>
            <option value="1">1 - Genoteerd in deze tabel</option>
            <option value="2">2 - Magazijnmedewerker verzamelt het artikel (picking)</option>
            <option value="3">3 - Tas met artikel is bij de bezorger</option>
            <option value="4">4 - Tas met artikel is afgeleverd bij de klant</option>
        </select>
        <br>

        <?php if (!empty($errors)) { ?>
            <div class="error">
                <?php foreach ($errors as $error) { ?>
                    <p><?php echo $error; ?></p>
                <?php } ?>
            </div>
        <?php } ?>

        <input type="submit" name="submit" value="Toevoegen">
    </form>
</body>

</html>

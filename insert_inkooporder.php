<?php

require_once 'classes/Database.php';
require_once 'classes/Inkooporder.php';
include 'navbar.php';
// Create a new instance of the Database class
$database = new Database();
$conn = $database->getConnection();

// Query to retrieve leverancier data
$query = "SELECT levId, levNaam FROM leveranciers";
$stmt = $conn->prepare($query);
$stmt->execute();

// Fetch the leverancier data
$leveranciers = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Query to retrieve artikel data
$query = "SELECT artId, artOmschrijving FROM artikelen";
$stmt = $conn->prepare($query);
$stmt->execute();

// Fetch the artikel data
$artikelen = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Close the database connection
$conn = null;

// Form submission handling
$errors = [];

if (isset($_POST['submit'])) {
    $levId = $_POST['levId'];
    $artId = $_POST['artId'];
    $inkOrdDatum = $_POST['inkOrdDatum'];
    $inkOrdBestAantal = $_POST['inkOrdBestAantal'];
    $inkOrdStatus = $_POST['inkOrdStatus'];

    // Validate form fields
    if (empty($levId)) {
        $errors[] = "Leverancier is verplicht.";
    }

    if (empty($artId)) {
        $errors[] = "Artikel is verplicht.";
    }

    if (empty($inkOrdDatum)) {
        $errors[] = "Datum is verplicht.";
    }

    if (empty($inkOrdBestAantal)) {
        $errors[] = "Bestelhoeveelheid is verplicht.";
    }

    if (empty($inkOrdStatus)) {
        $errors[] = "Status is verplicht.";
    }

    // If there are no errors, create the inkooporder
    if (empty($errors)) {
        $inkooporder = new Inkooporder();
        $result = $inkooporder->createInkooporder($levId, $artId, $inkOrdDatum, $inkOrdBestAantal, $inkOrdStatus);

        if ($result) {
            // Redirect to success page or display a success message
            header("Location: inkooporders_inzien.php");
            exit();
        } else {
            $errors[] = "Er is een fout opgetreden bij het toevoegen van de inkooporder.";
        }
    }
}

?>

<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="styles.css">
    <title>Inkooporder</title>
</head>

<body>
    <h1>Inkooporder</h1>

    <h2>Nieuwe inkooporder toevoegen</h2>

    <form method="post" action="insert_inkooporder.php">
        <label for="levId">Leverancier:</label>
        <select name="levId" required>
            <option value="">Kies een leverancier</option>
            <?php foreach ($leveranciers as $leverancier) { ?>
                <option value="<?php echo $leverancier['levId']; ?>"><?php echo $leverancier['levNaam']; ?></option>
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

        <label for="inkOrdDatum">Datum:</label>
        <input type="date" name="inkOrdDatum" value="<?php echo date('Y-m-d'); ?>" required>
        <br>

        <label for="inkOrdBestAantal">Bestelhoeveelheid:</label>
        <input type="number" name="inkOrdBestAantal" required>
        <br>

        <label for="inkOrdStatus">Status:</label>
        <select name="inkOrdStatus" required>
            <option value="1">1 - Het artikel in Niet geleverd</option>
            <option value="2">2 - Het artikel in Wel geleverd</option>
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
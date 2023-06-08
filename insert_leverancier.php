<?php
// Include the Leverancier class
require_once 'classes/Leverancier.php';
include 'navbar.php';
// Process the form submission
if (isset($_POST['submit'])) {
    // Retrieve the submitted data
    $levNaam = $_POST['levNaam'];
    $levContact = $_POST['levContact'];
    $levEmail = $_POST['levEmail'];
    $levAdres = $_POST['levAdres'];
    $levPostcode = $_POST['levPostcode'];
    $levWoonplaats = $_POST['levWoonplaats'];

    // Add the leverancier to the database
    if (Leverancier::addLeverancier($levNaam, $levContact, $levEmail, $levAdres, $levPostcode, $levWoonplaats)) {
        echo "Leverancier successfully added.";
    } else {
        echo "An error occurred while adding the leverancier.";
    }
}
?>

<!-- HTML form to input leverancier details -->
<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="styles.css">
    <title>Leveranciergegevens</title>
</head>

<body>
    <h1>Leveranciergegevens</h1>

    <!-- Leverancier form -->
    <h2>Nieuwe leverancier toevoegen</h2>
    <form method="post" action="insert_leverancier.php">
        Naam: <input type="text" name="levNaam" required><br>
        Contactpersoon: <input type="text" name="levContact" required><br>
        Email: <input type="email" name="levEmail" required><br>
        Adres: <input type="text" name="levAdres" required><br>
        Postcode: <input type="text" name="levPostcode" required><br>
        Woonplaats: <input type="text" name="levWoonplaats" required><br>
        <input type="submit" name="submit" value="Toevoegen">
    </form>
</body>

</html>

<?php
// Inclusief de klantklasse
require_once 'classes/Klant.php';
include 'navbar.php';
// Verwerk het formulierinzending
if (isset($_POST['submit'])) {
    // Ontvang de ingediende gegevens
    $naam = $_POST['naam'];
    $email = $_POST['email'];
    $adres = $_POST['adres'];
    $postcode = $_POST['postcode'];
    $woonplaats = $_POST['woonplaats'];

    // Voeg de klant toe aan de database
    if (Klant::addKlant($naam, $email, $adres, $postcode, $woonplaats)) {
        echo "Klant succesvol toegevoegd.";
    } else {
        echo "Er is een fout opgetreden bij het toevoegen van de klant.";
    }
}
?>

<!-- HTML-formulier om klantgegevens in te voeren -->
<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="styles.css">
    <title>Klantgegevens</title>
</head>

<body>
    <h1>Klantgegevens</h1>

    <!-- Klantformulier -->
    <h2>Nieuwe klant toevoegen</h2>
    <form method="post" action="insert_klant.php">
        Naam: <input type="text" name="naam" required><br>
        Email: <input type="email" name="email" required><br>
        Adres: <input type="text" name="adres" required><br>
        Postcode: <input type="text" name="postcode" required><br>
        Woonplaats: <input type="text" name="woonplaats" required><br>
        <input type="submit" name="submit" value="Toevoegen">
    </form>
</body>

</html>

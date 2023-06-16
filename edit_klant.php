<?php
// Inclusief de klantklasse
require_once 'classes/klant.php';

// Verwerk het formulierinzending
if (isset($_POST['submit'])) {
    // Ontvang de ingediende gegevens
    $klantId = $_POST['klantId'];
    $naam = $_POST['naam'];
    $email = $_POST['email'];
    $adres = $_POST['adres'];
    $postcode = $_POST['postcode'];
    $woonplaats = $_POST['woonplaats'];

    // Bewerk de klant in de database
    if (Klant::editKlant($klantId, $naam, $email, $adres, $postcode, $woonplaats)) {
        echo "Klant succesvol bewerkt.";

        // JavaScript redirect naar insert_klant.php
        echo "<script>window.location.href = 'klanten_inzien.php';</script>";
        exit; // Stop verdere verwerking van de pagina
    } else {
        echo "Er is een fout opgetreden bij het bewerken van de klant.";
    }
}

// Haal de klantgegevens op
if (isset($_GET['id'])) {
    $klantId = $_GET['id'];
    $klant = Klant::getKlantById($klantId);
}
?>

<!-- HTML-formulier om klantgegevens te bewerken -->
<!DOCTYPE html>
<html>

<head>
    <title>Klantgegevens bewerken</title>
</head>

<body>
    <h1>Klantgegevens bewerken</h1>

    <form method="post" action="">
        <input type="hidden" name="klantId" value="<?php echo $klant['klantId']; ?>">
        Naam: <input type="text" name="naam" value="<?php echo $klant['klantNaam']; ?>" required><br>
        Email: <input type="email" name="email" value="<?php echo $klant['klantEmail']; ?>" required><br>
        Adres: <input type="text" name="adres" value="<?php echo $klant['klantAdres']; ?>" required><br>
        Postcode: <input type="text" name="postcode" value="<?php echo $klant['klantPostcode']; ?>" required><br>
        Woonplaats: <input type="text" name="woonplaats" value="<?php echo $klant['klantWoonplaats']; ?>" required><br>
        <input type="submit" name="submit" value="Opslaan">
    </form>
</body>

</html>
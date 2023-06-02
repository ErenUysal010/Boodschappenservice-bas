<?php
// Inclusief de klantklasse
require_once 'klant.php';

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

// Haal alle klanten op
$klanten = Klant::getKlanten();
?>

<!-- HTML-formulier om klantgegevens in te voeren -->
<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="styles.css">
    <title>Klantgegevens</title>
</head>

<body>
    <a href="index.php">Terug naar hoofdpagina</a>
    <h1>Klantgegevens</h1>

    <!-- Klantformulier -->
    <h2>Nieuwe klant toevoegen</h2>
    <form method="post" action="">
        Naam: <input type="text" name="naam" required><br>
        Email: <input type="email" name="email" required><br>
        Adres: <input type="text" name="adres" required><br>
        Postcode: <input type="text" name="postcode" required><br>
        Woonplaats: <input type="text" name="woonplaats" required><br>
        <input type="submit" name="submit" value="Toevoegen">
    </form>

    <!-- Bestaande klanten -->
    <h2>Bestaande klanten</h2>
    <table>
        <tr>
            <th>Klant ID</th>
            <th>Naam</th>
            <th>Email</th>
            <th>Adres</th>
            <th>Postcode</th>
            <th>Woonplaats</th>
        </tr>
        <?php foreach ($klanten as $klant) { ?>
            <tr>
                <td><?php echo $klant['klantId']; ?></td>
                <td><?php echo $klant['klantNaam']; ?></td>
                <td><?php echo $klant['klantEmail']; ?></td>
                <td><?php echo $klant['klantAdres']; ?></td>
                <td><?php echo $klant['klantPostcode']; ?></td>
                <td><?php echo $klant['klantWoonplaats']; ?></td>
                <td><a href="edit_klant.php?id=<?php echo $klant['klantId']; ?>">Bewerken</a></td>
                <td><a href="delete_klant.php?id=<?php echo $klant['klantId']; ?>">Verwijderen</a></td>
            </tr>
        <?php } ?>
    </table>
</body>

</html>

<?php
// Inclusief de artikelklasse
require_once 'classes/Artikel.php';
require_once 'classes/Leverancier.php';
include 'navbar.php';

// Verwerk het formulierinzending
if (isset($_POST['submit'])) {
    // Ontvang de ingediende gegevens
    $artOmschrijving = $_POST['artOmschrijving'];
    $artInkoop = $_POST['artInkoop'];
    $artVerkoop = $_POST['artVerkoop'];
    $artVoorraad = $_POST['artVoorraad'];
    $artMinVoorraad = $_POST['artMinVoorraad'];
    $artMaxVoorraad = $_POST['artMaxVoorraad'];
    $levId = $_POST['levId'];

    // Voeg het artikel toe aan de database
    if (Artikel::addArtikel(null, $artOmschrijving, $artInkoop, $artVerkoop, $artVoorraad, $artMinVoorraad, $artMaxVoorraad, $levId)) {
        echo "Artikel succesvol toegevoegd.";
    } else {
        echo "Er is een fout opgetreden bij het toevoegen van het artikel.";
    }
}

// Haal de leveranciers op voor de dropdown
$leveranciers = Leverancier::getLeveranciers();
?>

<!-- HTML-formulier om artikelgegevens in te voeren -->
<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="styles.css">
    <title>Artikelgegevens</title>
</head>

<body>
    <h1>Artikelgegevens</h1>

    <!-- Artikel formulier -->
    <h2>Nieuw artikel toevoegen</h2>
    <form method="post" action="insert_artikel.php">
        Omschrijving: <input type="text" name="artOmschrijving" required><br>
        Inkoopprijs: <input type="text" name="artInkoop" required><br>
        Verkoopprijs: <input type="text" name="artVerkoop" required><br>
        Voorraad: <input type="text" name="artVoorraad" required><br>
        Minimum Voorraad: <input type="text" name="artMinVoorraad" required><br>
        Maximum Voorraad: <input type="text" name="artMaxVoorraad" required><br>
        Leverancier:
        <select name="levId" required>
            <?php foreach ($leveranciers as $leverancier) { ?>
                <option value="<?php echo $leverancier['levId']; ?>"><?php echo $leverancier['levId'] . ' - ' . $leverancier['levNaam']; ?></option>
            <?php } ?>
        </select><br>
        <input type="submit" name="submit" value="Toevoegen">
    </form>
</body>

</html>

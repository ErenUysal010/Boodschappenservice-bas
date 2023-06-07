<?php
// Inclusief de artikelklasse
require_once 'classes/Artikel.php';

// Verwerk het formulierinzending
if (isset($_POST['submit'])) {
    // Ontvang de ingediende gegevens
    $artOmschrijving = $_POST['artOmschrijving'];
    $artInkoop = $_POST['artInkoop'];
    $artVerkoop = $_POST['artVerkoop'];
    $artVoorraad = $_POST['artVoorraad'];
    $artMinVoorraad = $_POST['artMinVoorraad'];
    $artMaxVoorraad = $_POST['artMaxVoorraad'];
    $artLocatie = (int)$_POST['artLocatie']; // Converteer naar een integer

    // Voeg het artikel toe aan de database
    if (Artikel::addArtikel(null, $artOmschrijving, $artInkoop, $artVerkoop, $artVoorraad, $artMinVoorraad, $artMaxVoorraad, $artLocatie)) {
        echo "Artikel succesvol toegevoegd.";
    } else {
        echo "Er is een fout opgetreden bij het toevoegen van het artikel.";
    }
}
?>

<!-- HTML-formulier om artikelgegevens in te voeren -->
<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="styles.css">
    <title>Artikelgegevens</title>
</head>

<body>
    <a href="index.php">Terug naar hoofdpagina</a>
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
        Locatie: <input type="text" name="artLocatie" required><br>
        <input type="submit" name="submit" value="Toevoegen">
    </form>
</body>

</html>

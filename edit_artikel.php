<?php
// Inclusief de artikelklasse
require_once 'classes/Artikel.php';
include 'navbar.php';

// Controleer of de artId aanwezig is in de URL
if (isset($_GET['artId'])) {
    $artId = $_GET['artId'];

    // Haal het artikel op uit de database
    $artikel = Artikel::getArtikelById($artId);

    // Controleer of het artikel bestaat
    if ($artikel) {
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

            // Bijwerk het artikel in de database
            if ($artikel->updateArtikel($artOmschrijving, $artInkoop, $artVerkoop, $artVoorraad, $artMinVoorraad, $artMaxVoorraad, $artLocatie)) {
                echo "Artikel succesvol bijgewerkt.";
            } else {
                echo "Er is een fout opgetreden bij het bijwerken van het artikel.";
            }
        }

        // HTML-formulier om artikelgegevens weer te geven en bij te werken
        ?>
        <!DOCTYPE html>
        <html>

        <head>
            <link rel="stylesheet" href="styles.css">
            <title>Artikelgegevens</title>
        </head>

        <body>
            <h1>Artikelgegevens</h1>

            <!-- Artikel formulier -->
            <h2>Artikel bewerken</h2>
            <form method="post" action="edit_artikel.php?artId=<?php echo $artikel->getId(); ?>">
                Omschrijving: <input type="text" name="artOmschrijving" value="<?php echo $artikel->getOmschrijving(); ?>" required><br>
                Inkoopprijs: <input type="text" name="artInkoop" value="<?php echo $artikel->getInkoop(); ?>" required><br>
                Verkoopprijs: <input type="text" name="artVerkoop" value="<?php echo $artikel->getVerkoop(); ?>" required><br>
                Voorraad: <input type="text" name="artVoorraad" value="<?php echo $artikel->getVoorraad(); ?>" required><br>
                Minimum Voorraad: <input type="text" name="artMinVoorraad" value="<?php echo $artikel->getMinVoorraad(); ?>" required><br>
                Maximum Voorraad: <input type="text" name="artMaxVoorraad" value="<?php echo $artikel->getMaxVoorraad(); ?>" required><br>
                Locatie: <input type="text" name="artLocatie" value="<?php echo $artikel->getLocatie(); ?>" required><br>
                <input type="submit" name="submit" value="Bijwerken">
            </form>
        </body>

        </html>
        <?php
    } else {
        echo "Artikel niet gevonden.";
    }
} else {
    echo "Artikel-ID niet opgegeven.";
}
?>

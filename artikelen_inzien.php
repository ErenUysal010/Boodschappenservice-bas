<?php
// Inclusief de artikelklasse
require_once 'classes/Artikel.php';
include 'navbar.php';
// Haal alle artikelen op
$artikelen = Artikel::getArtikelen();
?>

<!-- HTML om bestaande artikelen weer te geven -->
<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="styles.css">
    <title>Artikelgegevens</title>
</head>

<body>
    <h1>Artikelgegevens</h1>

    <!-- Bestaande artikelen -->
    <h2>Bestaande artikelen</h2>
    <table>
        <tr>
            <th>Artikel ID</th>
            <th>Omschrijving</th>
            <th>Inkoopprijs</th>
            <th>Verkoopprijs</th>
            <th>Voorraad</th>
            <th>Minimale Voorraad</th>
            <th>Maximale Voorraad</th>
            <th>Locatie</th>
        </tr>
        <?php foreach ($artikelen as $artikel) { ?>
            <tr>
                <td><?php echo $artikel['artId']; ?></td>
                <td><?php echo $artikel['artOmschrijving']; ?></td>
                <td><?php echo $artikel['artInkoop']; ?></td>
                <td><?php echo $artikel['artVerkoop']; ?></td>
                <td><?php echo $artikel['artVoorraad']; ?></td>
                <td><?php echo $artikel['artMinVoorraad']; ?></td>
                <td><?php echo $artikel['artMaxVoorraad']; ?></td>
                <td><?php echo $artikel['artLocatie']; ?></td>
                <td><a href="edit_artikel.php?id=<?php echo $artikel['artId']; ?>">Bewerken</a></td>
                <td><a href="delete_artikel.php?id=<?php echo $artikel['artId']; ?>">Verwijderen</a></td>
            </tr>
        <?php } ?>
    </table>
</body>

</html>

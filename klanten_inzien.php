<?php
// Inclusief de klantklasse
require_once 'classes/Klant.php';

// Haal alle klanten op
$klanten = Klant::getKlanten();
?>

<!-- HTML om bestaande klanten weer te geven -->
<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="styles.css">
    <title>Klantgegevens</title>
</head>

<body>
    <a href="index.php">Terug naar hoofdpagina</a>
    <h1>Klantgegevens</h1>

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

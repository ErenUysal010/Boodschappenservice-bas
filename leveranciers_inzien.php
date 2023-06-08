<?php
// Inclusief de leverancierklasse
require_once 'classes/Leverancier.php';
include 'navbar.php';

// Haal alle leveranciers op
$leveranciers = Leverancier::getLeveranciers();
?>

<!-- HTML om bestaande leveranciers weer te geven -->
<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="styles.css">
    <title>Leveranciergegevens</title>
</head>

<body>
    <h1>Leveranciergegevens</h1>

    <!-- Bestaande leveranciers -->
    <h2>Bestaande leveranciers</h2>
    <table>
        <tr>
            <th>Leverancier ID</th>
            <th>Naam</th>
            <th>Contactpersoon</th>
            <th>Email</th>
            <th>Adres</th>
            <th>Postcode</th>
            <th>Woonplaats</th>
        </tr>
        <?php foreach ($leveranciers as $leverancier) { ?>
            <tr>
                <td><?php echo $leverancier['levId']; ?></td>
                <td><?php echo $leverancier['levNaam']; ?></td>
                <td><?php echo $leverancier['levContact']; ?></td>
                <td><?php echo $leverancier['levEmail']; ?></td>
                <td><?php echo $leverancier['levAdres']; ?></td>
                <td><?php echo $leverancier['levPostcode']; ?></td>
                <td><?php echo $leverancier['levWoonplaats']; ?></td>
                <td><a href="edit_leverancier.php?id=<?php echo $leverancier['levId']; ?>">Bewerken</a></td>
                <td><a href="delete_leverancier.php?id=<?php echo $leverancier['levId']; ?>">Verwijderen</a></td>
            </tr>
        <?php } ?>
    </table>
</body>

</html>

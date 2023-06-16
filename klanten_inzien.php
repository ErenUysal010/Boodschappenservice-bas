<?php
// Inclusief de Klant-klasse
require_once 'classes/Klant.php';
include 'navbar.php';

// Verwerk zoekparameters
$searchTerm = $_GET['search'] ?? '';

// Haal alle klanten op of alleen de gezochte klant(en)
if (!empty($searchTerm)) {
    // Controleren of de zoekterm een numerieke waarde is (klant-ID)
    if (is_numeric($searchTerm)) {
        $klanten = [Klant::getKlantById($searchTerm)];
    } else {
        $klanten = Klant::zoekKlanten($searchTerm);
    }
} else {
    $klanten = Klant::getKlanten();
}
?>

<!-- HTML om bestaande klanten weer te geven -->
<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="styles.css">
    <title>Klantgegevens</title>
</head>

<body>
    <h1>Klantgegevens</h1>

    <!-- Zoekformulier -->
    <form method="get" action="klanten_inzien.php">
        <input type="text" name="search" placeholder="Klant ID of Naam" value="<?php echo $searchTerm; ?>">
        <button type="submit">Zoeken</button>
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

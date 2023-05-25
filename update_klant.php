<!DOCTYPE html>
<html>

<body>
    <h1>CRUD klant</h1>
    <h2>Wijzigen</h2>

    <?php

    include_once 'classes/database.php';
    include_once 'classes/klant.php';

    $klant = new Klant();

    if (isset($_POST["update"]) && $_POST["update"] == "Wijzigen") {
        $klantId = $_POST['klantId'];
        $klantNaam = $_POST['klantNaam'];
        $klantEmail = $_POST['klantEmail'];
        $klantAdres = $_POST['klantAdres'];
        $klantPostcode = $_POST['klantPostcode'];
        $klantWoonplaats = $_POST['klantWoonplaats'];

        $klant->updateKlant2($klantId, $klantNaam, $klantEmail, $klantAdres, $klantPostcode, $klantWoonplaats);
        echo '<script>alert("Klant is gewijzigd")</script>';
    }

    if (isset($_GET['nr'])) {
        $row = $klant->getKlant($_GET['nr']);
    }
    ?>

    <form method="post">
        <input type='hidden' name='klantId' value='<?php echo $row["klantId"]; ?>'>
        <label for="vn">Voornaam:</label>
        <input type='text' id="vn" name='klantNaam' required value="<?php echo $row["klantNaam"]; ?>"><br>
        <label for="an">Achternaam:</label>
        <input type='text' id="an" name='klantAchternaam' required value='<?php echo $row["klantAchternaam"]; ?>'><br><br>
        <input type='submit' name='update' value='Wijzigen'>
    </form><br>

    <a href='index.php'>Terug</a>

</body>

</html>
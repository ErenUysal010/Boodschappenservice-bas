<?php
require_once 'create_verkooporder.php';

// Verwerk het ingediende formulier en sla de verkoopgegevens op in de database
if (isset($_POST['submit'])) {
    $klantId = $_POST['klantId'];
    $artId = $_POST['artId'];
    $verkOrdDatum = $_POST['verkOrdDatum'];
    $verkOrdBestAantal = $_POST['verkOrdBestAantal'];
    $verkOrdStatus = $_POST['verkOrdStatus'];
    
    // Opslaan van de verkoopgegevens in de database
    Verkooporder::create_verkooporder($klantId, $artId, $verkOrdDatum, $verkOrdBestAantal, $verkOrdStatus);

    // Redirect naar insert_verkooporder.php
    header("Location: insert_verkooporder.php");
    exit;
}

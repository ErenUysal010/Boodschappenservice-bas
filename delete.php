<?php

if(isset($_POST["verwijderen"])){
    include 'classes/database.php';
    include 'classes/klant.php';

    // Create a Klant object
    $klant = new Klant();

    // Delete klant based on klantId
    $klantId = $_GET["klantId"];
    $klant->deleteKlant($klantId);
    echo '<script>alert("Klant verwijderd")</script>';
    echo "<script> location.replace('index.php'); </script>";
}

<?php
// Databaseconfiguratie
$host = "localhost";
$username = "root";
$password = "";
$database = "bas_db";

try {
    // Verbinding maken met de database met behulp van PDO
    $conn = new PDO("mysql:host=$host;dbname=$database", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Fout bij het verbinden met de database: " . $e->getMessage());
}

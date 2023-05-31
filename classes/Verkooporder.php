<?php

class Database
{
    protected static $conn = NULL;

    private $servername = "localhost";
    private $dbname = "bas_db";
    private $username = "root";
    private $password = "";

    public function __construct()
    {
        if (!self::$conn) {
            try {
                self::$conn = new PDO("mysql:host=$this->servername;dbname=$this->dbname", $this->username, $this->password);
                self::$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                self::$conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
                // echo "Connectie is gelukt <br />";
            } catch (PDOException $e) {
                echo "Connectie mislukt: " . $e->getMessage();
            }
        } else {
            echo "Database is al geconnected<br>";
        }
    }

    public function getConnection()
    {
        return self::$conn;
    }
}

class Verkooporder
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function createOrder($klantId, $artId, $verkOrdDatum, $verkOrdBestAantal, $verkOrdStatus)
    {
        $conn = $this->db->getConnection();
        $query = "INSERT INTO verkooporders (klantId, artId, verkOrdDatum, verkOrdBestAantal, verkOrdStatus) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($query);
        $stmt->execute([$klantId, $artId, $verkOrdDatum, $verkOrdBestAantal, $verkOrdStatus]);

        if ($stmt->rowCount() > 0) {
            return "Verkooporder succesvol aangemaakt!";
        } else {
            return "Er is een fout opgetreden bij het aanmaken van de verkooporder.";
        }
    }

    public function getOrders()
    {
        $conn = $this->db->getConnection();
        $query = "SELECT * FROM verkooporders";
        $stmt = $conn->query($query);
        $orders = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $orders;
    }
}

$verkooporder = new Verkooporder();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $klantId = $_POST['klantId'];
    $artId = $_POST['artId'];
    $verkOrdDatum = $_POST['verkOrdDatum'];
    $verkOrdBestAantal = $_POST['verkOrdBestAantal'];
    $verkOrdStatus = $_POST['verkOrdStatus'];

    $result = $verkooporder->createOrder($klantId, $artId, $verkOrdDatum, $verkOrdBestAantal, $verkOrdStatus);
    echo $result;
}

$orders = $verkooporder->getOrders();

foreach ($orders as $order) {
    echo "Order ID: " . $order['orderId'] . "<br>";
    echo "Klant ID: " . $order['klantId'] . "<br>";
    echo "Artikel ID: " . $order['artId'] . "<br>";
    echo "Datum: " . $order['verkOrdDatum'] . "<br>";
    echo "Bestelde Aantal: " . $order['verkOrdBestAantal'] . "<br>";
    echo "Status: " . $order['verkOrdStatus'] . "<br>";
    echo "<br>";
}

?>
<!DOCTYPE html>
<html>

<head>
    <title>Verkooporder beheer</title>
    <link rel="stylesheet" type="text/css" href="style.css">

</head>
 
<body>
    <h1>Verkooporder aanmaken</h1>
    <form method="post" action="verkooporder.php">
        <label for="klantId">Klant ID:</label>
        <input type="text" name="klantId" id="klantId" required><br>

        <label for="artId">Artikel ID:</label>
        <input type="text" name="artId" id="artId" required><br>

        <label for="verkOrdDatum">Datum:</label>
        <input type="date" name="verkOrdDatum" id="verkOrdDatum" required><br>

        <label for="verkOrdBestAantal">Bestelde Aantal:</label>
        <input type="number" name="verkOrdBestAantal" id="verkOrdBestAantal" required><br>

        <label for="verkOrdStatus">Status:</label>
        <input type="text" name="verkOrdStatus" id="verkOrdStatus" required><br>

        <input type="submit" value="Verkooporder aanmaken">
    </form>

    <h2>Bestaande verkooporders</h2>
    <table>
        <tr>
            <th>Order ID</th>
            <th>Klant ID</th>
            <th>Artikel ID</th>
            <th>Datum</th>
            <th>Bestelde Aantal</th>
            <th>Status</th>
        </tr>
        <?php
        $orders = $verkooporder->getOrders();

        foreach ($orders as $order) {
            echo "<tr>";
            echo "<td>" . $order['orderId'] . "</td>";
            echo "<td>" . $order['klantId'] . "</td>";
            echo "<td>" . $order['artId'] . "</td>";
            echo "<td>" . $order['verkOrdDatum'] . "</td>";
            echo "<td>" . $order['verkOrdBestAantal'] . "</td>";
            echo "<td>" . $order['verkOrdStatus'] . "</td>";
            echo "</tr>";
        }
        ?>
    </table>
</body>

</html>
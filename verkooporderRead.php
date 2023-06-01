<!DOCTYPE html>
<html lang="en">
<head>
    <title>Verkooporder Read</title>
</head>
<body>
    <div class="content">
        <div class="accountPage">
            <div class="basCard">
                <div class="CardContent">
                    <h1>Read Verkooporder</h1>
                    <p>Zoek verkooporder op ID:</p>
                    <form action="verkooporderSearchId.php" method='POST'>
                        <label for="verkOrdId">ID:</label>
                        <input type="text" id='verkOrdId' name='verkOrdId'>
                        <input type="submit">
                    </form>
                    <?php
                        // require 'database.php';
                        if (isset($_SESSION['result'])) {
                            $result = $_SESSION['result'];
                            echo '<div class=""';
                            echo "Klant ID: " . $result['klantId'] . "<br>";
                            echo "Artikel ID: " . $result['artId'] . "<br>";
                            echo "Datum: " . $result['verkOrdDatum'] . "<br>";
                            echo "Bestelde Aantal: " . $result['verkOrdBestAantal'] . "<br>";
                            echo "Order Status: " . $result['verkOrdStatus'] . "<br>";
                            echo '</div>';
                            // unset the session variable once it's been displayed
                            unset($_SESSION['result']);
                        } else if (isset($_SESSION['searchMsg'])) {
                            echo $_SESSION['searchMsg'];
                            unset($_SESSION['searchMsg']);
                        }
                        ?>
                        <div class="divRead">
                            <p>Dit zijn alle verkooporders gegevens uit de database:</p>
                            <div class="read">
                                <?php 
                                    require 'Verkooporders.php';
                                    $verkOrd1 = new Verkooporders();
                                    $verkOrd1->readVerkooporders();
                                ?>
                                <div class="redirect">
                                    <a href="verkoopCreateForm.php">Create verkooporder</a>
                                </div>
                            </div>
                        <div id="messagePHP"><?php
                            if (isset($_SESSION['message'])) {
                                echo $_SESSION['message'];
                                unset($_SESSION['message']);
                            }
                            ?>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


</body>
</html>
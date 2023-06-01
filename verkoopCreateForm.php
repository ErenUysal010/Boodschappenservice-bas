<!DOCTYPE html>
<html lang="en">
<head>
    <title>Verkooporder Create</title>
</head>
<body>
<?php
   require_once 'Klant.php';
   $klanten = new Klant();
   require_once 'Artikel.php';
   $artikelen = new Artikel();
?>
<div class="content">
    <div class="accountPage">
        <div class="basCard">
            <div class="accountItems">
                <h1>Registreer nieuwe Verkooporder:</h1>
                <div class="accountForm">
                    <form method="post" id="register" action="verkoopCreate.php" class="form">
                        <label for="klantId">Klant ID:</label>
                        <select id="klantId" name="klantId">
                            <option value="23">23</option>
                            <option value="29">29</option>
                            <option value="31">31</option>
                            <option value="45">45</option>
                        </select>
                        <?php
                          /*$klanten = $klanten->getKlanten();
                          foreach ($klanten as $klant) {
                            echo '<option value="' . $klant['klantId'] . '">' . $klant['klantId'] . ' - ' . $klant['klantNaam'] . '</option>';
                        }*/
                        ?>
                        </select>
                        <br>
                        <label for="artId">Artikel ID:</label>
                        <select id="klantId" name="klantId">
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                        </select>
                            <?php
                                 /*$artikelen = $artikelen->getArtikelen();
                                 foreach ($artikelen as $artikel) {
                                     echo '<option value="' . $artikel['artId'] . '">' . $artikel['artId'] . ' - ' . $artikel['artOmschrijving'] . '</option>';
                                 }*/
                            ?>
                        </select>

                        <br>
                        <label for="verkOrdDatum">verkoop order Datum:</label>
                        <input type="DATE" id="verkOrdDatum" name="verkOrdDatum" required>
                        <br>
                        <label for="verkOrdBestAantal">verkoop order Bestel Aantal:</label>
                        <input type="int" id="verkOrdBestAantal" name="verkOrdBestAantal" required>
                        <br>
                        <lebel for="verkOrdStatus">verkoop order Status:</lebel>
                        <input type="hidden" name="verkOrdStatus">
                        <select name="verkOrdStatus" id="verkOrdStatus">
                            <option value="false">false</option>
                            <option value="true">true</option>
                        </select>
                        <br>
                        <div class="submitButton">
                            <input type="submit" name="verkoopCreate" value="Submit" class="registerClass">
                        </div>
                    </form>
                
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>
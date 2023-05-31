<?php

include_once 'classes/Database.php';

class Klanten extends Database
{
    public $klantId;
    public $klantNaam;
    public $klantEmail;
    public $klantAdres;
    public $klantPostcode;
    public $klantWoonplaats;

    // Methods

    public function setObject($klantId, $klantNaam, $klantEmail, $klantAdres, $klantPostcode, $klantWoonplaats)
    {
        $this->klantId = $klantId;
        $this->klantNaam = $klantNaam;
        $this->klantEmail = $klantEmail;
        $this->klantAdres = $klantAdres;
        $this->klantPostcode = $klantPostcode;
        $this->klantWoonplaats = $klantWoonplaats;
    }

    /**
     * Summary of getKlanten
     * @return mixed
     */
    public function getKlanten()
    {
        $lijst = self::$conn->query("SELECT * FROM klanten")->fetchAll();
        return $lijst;
    }

    // Get klant
    public function getKlant($klantId)
    {
        $sql = "SELECT * FROM klanten WHERE klantId = '$klantId'";
        $query = self::$conn->prepare($sql);
        $query->execute();
        return $query->fetch();
    }

    public function dropDownKlant($row_selected = -1)
    {
        $lijst = $this->getKlanten();

        echo "<label for='klanten'>Choose a klant:</label>";
        echo "<select name='klantId'>";
        foreach ($lijst as $row) {
            if ($row_selected == $row["klantId"]) {
                echo "<option value='$row[klantId]' selected='selected'> $row[klantNaam]</option>\n";
            } else {
                echo "<option value='$row[klantId]'> $row[klantNaam]</option>\n";
            }
        }
        echo "</select>";
    }

    /**
     * Summary of showTable
     * @param mixed $lijst
     * @return void
     */
    public function showTable($lijst)
    {
        $txt = "<table border=1px>";
        foreach ($lijst as $row) {
            $txt .= "<tr>";
            $txt .= "<td>" . $row["klantId"] . "</td>";
            $txt .= "<td>" . $row["klantNaam"] . "</td>";
            $txt .= "<td>" . $row["klantEmail"] . "</td>";
            $txt .= "<td>" . $row["klantAdres"] . "</td>";
            $txt .= "<td>" . $row["klantPostcode"] . "</td>";
            $txt .= "<td>" . $row["klantWoonplaats"] . "</td>";

            // Update
            $txt .= "<td>";
            $txt .= "<form method='post' action='update_acteur.php?klantId=$row[klantId]'>";
            $txt .= "<button name='update'>Wzg</button>";
            $txt .= "</form></td>";

            // Delete
            $txt .= "<td>";
            $txt .= "<form method='post' action='delete_acteur.php?klantId=$row[klantId]'>";
            $txt .= "<button name='delete'>Verwijder</button>";
            $txt .= "</form></td>";

            $txt .= "</tr>";
        }
        $txt .= "</table>";
        echo $txt;
    }
}

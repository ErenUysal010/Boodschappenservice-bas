<?php

include_once 'classes/Database.php';

class klant extends Database
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
			$txt .= "
            <form method='post' action='update_acteur.php?klantId=$row[klantId]'>
                <button name='update'>Wzg</button>
            </form> </td>";

			// Delete
			$txt .= "<td>";
			$txt .= "
            <form method='post' action='delete.php?klantId=$row[klantId]'>
                <button name='verwijderen'>Verwijderen</button>
            </form> </td>";
			$txt .= "</tr>";
		}
		$txt .= "</table>";
		echo $txt;
	}

	// Delete klant
	/**
	 * Summary of deleteKlant
	 * @param mixed $klantId
	 * @return bool
	 */
	public function deleteKlant($klantId)
	{
		$sql = "DELETE FROM klanten WHERE klantId = '$klantId'";
		$stmt = self::$conn->prepare($sql);
		$stmt->execute();
		return ($stmt->rowCount() == 1) ? true : false;
	}

	public function updateKlant2($klantId, $naam, $email, $adres, $postcode, $woonplaats)
	{
		$sql = "UPDATE klanten
			SET klantNaam = '$naam', klantEmail = '$email', klantAdres = '$adres', klantPostcode = '$postcode', klantWoonplaats = '$woonplaats'
			WHERE klantId = '$klantId'";

		$stmt = self::$conn->prepare($sql);
		$stmt->execute();
		return ($stmt->rowCount() == 1) ? true : false;
	}

	public function updateKlantSanitized($klantId, $naam, $email, $adres, $postcode, $woonplaats)
	{
		$sql = "UPDATE klanten
			SET klantNaam = :naam, klantEmail = :email, klantAdres = :adres, klantPostcode = :postcode, klantWoonplaats = :woonplaats
			WHERE klantId = :klantId";

		$stmt = self::$conn->prepare($sql);
		$stmt->execute([
			'naam' => $naam,
			'email' => $email,
			'adres' => $adres,
			'postcode' => $postcode,
			'woonplaats' => $woonplaats,
			'klantId' => $klantId
		]);
	}

	public function updateKlant()
	{
		$sql = "UPDATE klanten
			SET klantNaam = :klantNaam, klantEmail = :klantEmail, klantAdres = :klantAdres, klantPostcode = :klantPostcode, klantWoonplaats = :klantWoonplaats
			WHERE klantId = :klantId";

		$stmt = self::$conn->prepare($sql);
		$stmt->execute([
			'klantNaam' => $this->klantNaam,
			'klantEmail' => $this->klantEmail,
			'klantAdres' => $this->klantAdres,
			'klantPostcode' => $this->klantPostcode,
			'klantWoonplaats' => $this->klantWoonplaats,
			'klantId' => $this->klantId
		]);
		return ($stmt->rowCount() == 1) ? true : false;
	}

	/**
	 * Summary of BepMaxNr
	 * @return int
	 */
	private function BepMaxNr(): int
	{
		// Bepaal uniek nummer
		$sql = "SELECT MAX(klantId)+1 FROM klanten";
		return (int)self::$conn->query($sql)->fetchColumn();
	}

	public function insertKlant()
	{
		$this->klantId = $this->BepMaxNr();

		$sql = "INSERT INTO klanten (klantId, klantNaam, klantEmail, klantAdres, klantPostcode, klantWoonplaats)
		VALUES (:klantId, :klantNaam, :klantEmail, :klantAdres, :klantPostcode, :klantWoonplaats)";

		$stmt = self::$conn->prepare($sql);
		return $stmt->execute([
			'klantId' => $this->klantId,
			'klantNaam' => $this->klantNaam,
			'klantEmail' => $this->klantEmail,
			'klantAdres' => $this->klantAdres,
			'klantPostcode' => $this->klantPostcode,
			'klantWoonplaats' => $this->klantWoonplaats
		]);
	}

	/**
	 * Summary of insertKlant2
	 * @param mixed $naam
	 * @param mixed $email
	 * @param mixed $adres
	 * @param mixed $postcode
	 * @param mixed $woonplaats
	 * @return void
	 */
	public function insertKlant2($naam, $email, $adres, $postcode, $woonplaats)
	{
		$klantId = $this->BepMaxNr();
		$sql = "INSERT INTO klanten (klantId, klantNaam, klantEmail, klantAdres, klantPostcode, klantWoonplaats)
		VALUES (:klantId, :naam, :email, :adres, :postcode, :woonplaats)";

		$stmt = self::$conn->prepare($sql);
		$stmt->execute([
			'klantId' => $klantId,
			'naam' => $naam,
			'email' => $email,
			'adres' => $adres,
			'postcode' => $postcode,
			'woonplaats' => $woonplaats
		]);
	}
}

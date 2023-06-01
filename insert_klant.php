<?php

include_once 'classes/database.php';

class Klant extends Database
{
	public $klantId;
	public $klantNaam;
	public $klantEmail;
	public $klantAdres;
	public $klantPostcode;
	public $klantWoonplaats;

	public function BepMaxNr()
	{
		// Implementeer de logica om het maximale nummer te bepalen
		// en retourneer het resultaat
		// Bijvoorbeeld:
		// $maxNr = ...;
		// return $maxNr;
	}

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

if (isset($_POST["insert"]) && $_POST["insert"] == "Toevoegen") {
	include_once 'classes/klant.php';

	$klant = new Klanten;
	$klant->insertKlant2($_POST['voornaam'], $_POST['achternaam'], $_POST['email'], $_POST['adres'], $_POST['postcode'], $_POST['woonplaats']);

	echo "<script>alert('Klanten: $_POST[voornaam] $_POST[achternaam] is toegevoegd')</script>";
	echo "<script> location.replace('index.php'); </script>";
}

?>

<!DOCTYPE html>
<html>

<head>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
	<h1>CRUD klant</h1>
	<h2>Toevoegen</h2>
	<form method="post">
		<label for="nv">Voornaam:</label>
		<input type="text" id="nv" name="voornaam" placeholder="Voornaam" required /><br>
		<label for="an">Achternaam:</label>
		<input type="text" id="an" name="achternaam" placeholder="Achternaam" required /><br><br>
		<label for="em">Email:</label>
		<input type="text" id="em" name="email" placeholder="Email" required /><br>
		<label for="ad">Adres:</label>
		<input type="text" id="ad" name="adres" placeholder="Adres" required /><br>
		<label for="pc">Postcode:</label>
		<input type="text" id="pc" name="postcode" placeholder="Postcode" required /><br>
		<label for="wp">Woonplaats:</label>
		<input type="text" id="wp" name="woonplaats" placeholder="Woonplaats" required /><br><br>
		<input type='submit' name='insert' value='Toevoegen'>
	</form><br>
	<a href='index.php'>Terug</a>
</body>

</html>
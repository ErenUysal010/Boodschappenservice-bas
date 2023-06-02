<html>
<body>
<h1>Dropdown Klant</h1>

<?php
include_once 'klant.php';

// Create a Klant object
$klant = new Klant();
 
?>

<form method='post'>
	<?php
		isset($_POST['kies-btn']) ? $nr=$_POST['klantnr'] : $nr=-1;
		$klant->dropDownKlant($nr);
	?>
	<br>
	<input type='submit' name='kies-btn' value='Kies'></input>
</form>	

<?php

if (isset($_POST['kies-btn'])){
	$klant->klantId = $_POST['klantnr'];
	$row = $klant->getKlant($_POST['klantnr']);
	
	echo "Gekozen waarde: nr: $_POST[klantnr] $row[klantNaam] $row[klantEmail]"; 
}
?>

</body>
</html>
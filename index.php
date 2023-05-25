<html>
<!--
	Auteur: E. Uysal
	Functie: homepagina CRUD klant
-->

<body>
	<h1>CRUD Klant</h1>
	<nav>
		<a href='insert_klant.php'>Toevoegen nieuwe klant</a>
	</nav>]
	<h1>hello</h1>

	<?php

	// De classe definitie
	include_once "classes/klant.php";
	//$conn = dbConnect();

	// Maak een object klant
	$klant = new Klant;

	// Haal alle klanten op uit de database mbv de method getKlanten()
	$lijst = $klant->getKlanten();

	// Print een HTML-tabel van de lijst	
	$klant->showTable($lijst);
	?>
</body>

</html>
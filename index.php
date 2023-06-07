<html>
<!--
	Auteur: E. Uysal
	Functie: homepagina CRUD klant
-->

<head>
	<link rel="stylesheet" href="styles.css">
</head>

<body>
	<div class="navbar">
		<a class="active" href="index.php">Home</a>
		<div class="dropdown">
			<button class="dropbtn">Klanten
				<i class="fa fa-caret-down"></i>
			</button>
			<div class="dropdown-content">
				<a href='insert_klant.php'>Toevoegen nieuwe klant</a>
				<a href='klanten_inzien.php'>Klanten inzien</a>
			</div>
		</div>
		<div class="dropdown">
			<button class="dropbtn">Artiekelen
				<i class="fa fa-caret-down"></i>
			</button>
			<div class="dropdown-content">
				<a href='insert_artikel.php'>Toevoegen nieuwe artikel</a>
				<a href="artikelen_inzien.php">Artikelen inzien</a>
			</div>
		</div>
		<div class="dropdown">
			<button class="dropbtn">Verkooporder
				<i class="fa fa-caret-down"></i>
			</button>
			<div class="dropdown-content">
				<a href='insert_verkooporder.php'>Toevoegen verkooporder</a>
				<a href="verkooporders_inzien.php">Verkooporder inzien</a>
			</div>
		</div>
	</div>
	<h1>Bas opdracht</h1>

</body>

</html>
<!DOCTYPE html>
<html lang="en">
<head>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    
    <div class="navbar">
        <img class="logo" src="Images/Bas_Logo.png" alt="Bas-logo" >
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
				<a href="verkooporders_inzien.php">Verkooporders inzien</a>
			</div>
		</div>
		<div class="dropdown">
            <button class="dropbtn">Inkooporder
                <i class="fa fa-caret-down"></i>
			</button>
			<div class="dropdown-content">
                <a href='insert_inkooporder.php'>Toevoegen inkooporder</a>
				<a href="inkooporders_inzien.php"> Inkooporders inzien</a>
			</div>
		</div>
		<div class="dropdown">
            <button class="dropbtn">Leverancier
                <i class="fa fa-caret-down"></i>
			</button>
			<div class="dropdown-content">
                <a href='insert_leverancier.php'>Toevoegen leverancier</a>
				<a href="leveranciers_inzien.php">leveranciers inzien</a>
			</div>
		</div>
	</div>
    <br/>
    <script>
    $(document).ready(function() {
        $(".dropdown-content a").click(function() {
            // Verwijder "active" class van alle links binnen de dropdown
            $(".dropdown-content a").removeClass("active");
            // Voeg "active" class toe aan de geklikte link
            $(this).addClass("active");
        });

        // Controleer de huidige URL en markeer de juiste link als "active" bij het laden van de pagina
        var currentUrl = window.location.href;
        $(".dropdown-content a").each(function() {
            if (currentUrl.indexOf($(this).attr("href")) !== -1) {
                $(this).addClass("active");
            }
        });
    });
</script>




</body>
</html>